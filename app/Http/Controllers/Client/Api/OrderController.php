<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\{Cart,Order,Shipping,Coupon,OrderItem,CartItemوPointSetting,UserAddress};

use Exception;

use App\Http\Controllers\BaseController;

class OrderController extends Controller
{


    public function storeOrdersFromCart()
    {
        try {
          DB::beginTransaction();

          $user = auth('client')->user();
          $cart = $user->cart()->with('items.product.offer')->first();

          if (!$cart || $cart->items->isEmpty()) {
              return JsonResponse::respondError('Cart is empty');
          }

          foreach ($cart->items as $item) {
              if (!$item->product->active) {
                  return JsonResponse::respondError("منتج {$item->product->name} غير متاح حالياً.");
              }

              if ($item->quantity > $product->quantity) {
                  return JsonResponse::respondError("الكمية المطلوبة للمنتج {$product->name} غير متوفرة. الكمية المتاحة: {$product->quantity}");
              }
          }
          $master_order = MasterOrder::create([
              'user_id' => $user->id,
              'total' => 0,
              'status'  => 'pending'

          ]);

          //  تجميع المنتجات حسب الصيدلية

          $groupedItems = $cart->items->groupBy(fn($item) => $item->product->pharmacy_id);

          $orders = [];
          $total =0;
          foreach ($groupedItems as $pharmacyId => $items) {
              $subtotal = 0;
              $tax = 0;
              $itemsData = [];

              foreach ($items as $item) {
                  $product = $item->product;
                  $quantity = $item->quantity;
                  $basePrice = $product->price;
                  $offer = $product->offer;

                  $discount = 0;
                  $freeQty = 0;

                  if ($offer && $offer->is_active) {
                      if ($offer->type == 'discount') {
                          $discount = $offer->discount_type == 'percentage'
                              ? $basePrice * $offer->value / 100
                              : $offer->value;
                      }

                      // if ($offer->type == 'extra' && $quantity >= $offer->min_quantity) {
                      //     $freeQty = floor($quantity / $offer->min_quantity);
                      // }
                  }

                  $finalPrice = max($basePrice - $discount, 0);
                  $taxAmount = $finalPrice * ($product->tax_rate / 100);
                  $lineTotal = ($finalPrice + $taxAmount) * $quantity;

                  $subtotal += $finalPrice * $quantity;
                  $tax += $taxAmount * $quantity;

                  $itemsData[] = [
                      'product_id'    => $product->id,
                      'base_price'    => $basePrice,
                      'final_price'   => $finalPrice,
                      'tax_amount'    => $taxAmount,
                      'quantity'      => $quantity,
                      'total'         => $lineTotal,
                      'free_quantity' => $freeQty,
                  ];
              }
              $pointSetting = PointSetting::where('pharmacy_id', $pharmacyId)
                                ->where('is_active', true)->first();

              $earnedPoints = 0;

              if ($pointSetting && $pointSetting->earning_rate > 0) {
                  $earnedPoints = floor($subtotal * $pointSetting->earning_rate);
              }
              $order = $master_order->orders()->create([
                  'pharmacy_id'      => $pharmacyId,
                  'status'           => 'pending',
                  'subtotal'         => round($subtotal, 2),
                  'tax'              => round($tax, 2),
                  'order_discount'   => 0,
                  'total'            => round($subtotal + $tax, 2),
                  'paid_from_wallet' => 0,
                  'paid_by_card'     => 0,
                  'earned_points'    => $earnedPoints,
                  'is_paid'          => false,
                  'payment_type'     => null,
                  'due_date'         => now()->addDays(7),
                  'paid_amount'      => 0,
                  'remaining_amount' => round($subtotal + $tax, 2),
              ]);
              $total += $order->total;
              foreach ($itemsData as $item) {
                  $order->items()->create($item);
              }
              $this->addEarnedPointsToWallet( $order);

              $orders[] = $order;
          }

          $cart->items()->delete();
          $master_order->update(['total' => $total]);

          return JsonResponse::respondSuccess('تم إنشاء الطلبات بنجاح لكل صيدلية.', [
              'orders' => collect($orders)->pluck('id'),
          ]);
          DB::commit();

        }
        catch (Exception $e) {
            DB::rollBack();
            return JsonResponse::respondError($e->getMessage());
        }
    }
/////////////////////////////////////////////////////////////////////////////////

  public function couponApply(Request $request)
  {
      $request->validate([
        'code'=>'required|string',
      ]);
      try {
        DB::beginTransaction();
       $coupon = Coupon::where('code' ,$request->code)->first();


       if (!$coupon || !$coupon->isValid()) {
         return back()->with('fail','the discount code not valid or expired !');
       }
       $user = auth('client')->user();
       $order = Order::where('user_id',$user->id)->where('pharmacy_id',$coupon->pharmacy_id)->first();


       $order->coupon_id  = $coupon->id;
       $result = $this->calculateDiscount( $coupon , $order->total);
       $order->coupon_discount  = $result["discount"];
       $order->total  = $result["final_total"];
       $order->save();
       $master_order = $order->master_order;
       $master_order->total =  round(abs($master_order->total) - abs($result["discount"]),2);
       $master_order->save();
       DB::commit();
       return JsonResponse::respondSuccess(__('lang.coupon has been accepted'));
     } catch (Exception $e) {
         DB::rollBack();
         return JsonResponse::respondError($e->getMessage());
     }

  }
//////////////////////////////////////////////////////////////////////////
   public function applyShip(Request $request){
       $request->validate([
         'shipping_type'=>'required',
         'shipping_address'=>'required|exists:user_addresses,id',
       ]);


       try {
          DB::beginTransaction();
            $user = auth('client')->user();
            $address = UserAddress::find($request->shipping_address);
            $orders = Order::where('user_id',$user->id)->get();
            foreach ($orders as  $order) {
              $pharmacyId = $order->pharmacy_id;
              $shipping = Shipping::where('shipping_type' ,$request->shipping_type)->where('pharmacy_id' ,$pharmacyId)->first();
              if (!$shipping) {
                  return JsonResponse::respondError(__("lang.this shipping not available for:").$pharmacyId);
              }
              $order->shipping_id = $shipping->id;
              $order->shipping_cost = $shipping->value;
              $order->shipping_address = implode(' - ', array_filter([
                  $address->name,
                  $address->building,
                  $address->area,
                  $address->city,
                  "Tel: {$address->phone}"
              ]));
              $order->total = round($order->total + abs($shipping->value));
              $order->save();
              $master_order = $order->master_order;
              $master_order->total =  round(abs($master_order->total) + abs($shipping->value),2);
              $master_order->save();
            }
            DB::commit();
          return JsonResponse::respondSuccess(__('lang.shipping added successfully'));
      } catch (Exception $e) {
           DB::rollBack();
          return JsonResponse::respondError($e->getMessage());
      }
    }
////////////////////////////////////////////////////////////////////////////////////
  protected function calculateDiscount(Coupon $coupon , $total)
  {
    $discount = 0;

    if ($coupon['discount_type'] === 'percentage') {
        $discount = ($total * $coupon['discount_value']) / 100;
    } elseif ($coupon['discount_type'] === 'fixed') {
        $discount = $coupon['discount_value'];
    }

    $discount = min($discount, $total);

    $final_total = $total - $discount;
    return ["final_total" => $final_total ,"discount"=>$discount] ;
  }

  ///////////////////////////////////////////////////////////////////////////////////////////
  public function addEarnedPointsToWallet(Order $order)
  {
      if (!$order->earned_points || $order->earned_points <= 0) {
          return;
      }

      DB::beginTransaction();
      try {
          $wallet = Wallet::firstOrCreate(
              [
                  'user_id' => $order->user_id,
                  'pharmacy_id' => $order->pharmacy_id,
              ],
              [
                  'balance' => 0,
                  'point_balance' => 0,
              ]
          );


          $wallet->point_balance += $order->earned_points;
          $wallet->save();

          WalletTransaction::create([
              'wallet_id' => $wallet->id,
              'type' => 'earn_points',
              'points' => $order->earned_points,
              'amount' => null,
              'order_id' => $order->id,
              'description' => 'نقاط مكتسبة من الطلب رقم #' . $order->id,
          ]);

          DB::commit();
      } catch (\Exception $e) {
          DB::rollBack();
          report($e);
          throw $e;
      }
  }
   //////////////////////////////////////////////////////////////

}
