<?php
namespace App\Services;

use App\Models\{Cart, MasterOrder, Order, Shipping, Coupon, Wallet, WalletTransaction, PointSetting, UserAddress};
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderService
{
    public function createOrder($user, $request)
    {
        DB::beginTransaction();
        try {
            $cart = $user->cart()->with('items.product.offer')->first();

            if (!$cart || $cart->items->isEmpty()) {
                throw new \Exception(__('lang.cart_is_empty'));
            }

            foreach ($cart->items as $item) {
                $product = $item->product;

                if (!$product->active) {
                    throw new \Exception("منتج {$product->name} غير متاح حالياً.");
                }

                if ($item->quantity > $product->quantity) {
                    throw new \Exception("الكمية المطلوبة للمنتج {$product->name} غير متوفرة.");
                }
            }
            //  تحقق مسبق من الكوبون إن وُجد
             if ($request->filled('code')) {
                  $this->validateCouponOrFail($request->code, $cart);
             }

              //  تحقق مسبق من الشحن
             $this->validateShippingAvailableOrFail($request->shipping_type, $request->shipping_address, $cart);

             $master_order = MasterOrder::create([
                 'user_id' => $user->id,
                 'total' => 0,
                 'status'  => 'pending'

             ]);


             $groupedItems = $cart->items->groupBy(fn($item) => $item->product->pharmacy_id);

             $orders = [];
             $total =0;

             foreach ($groupedItems as $pharmacyId => $items) {
                 $subtotal = 0;
                 $tax = 0;
                 $itemsData = [];
                 $order_discount =0 ;
                 $order_taxes =0 ;
                 foreach ($items as $item) {
                     $product = $item->product;
                     $quantity = $item->quantity;
                     $basePrice = $product->price;
                     $offer = $product->offer;

                     $discount = 0;
                     $freeQty = 0;
                    $hasOffer = null;
                     if ($offer && $offer->is_active) {
                         if ($offer->type == 'discount') {
                             $discount = $offer->discount_type == 'percentage'
                                 ? $basePrice * $offer->value / 100
                                 : $offer->value;

                         }
                         $hasOffer = $offer;

                     }

                     $finalPrice = max($basePrice - $discount, 0);
                     $taxAmount = $finalPrice * ($product->tax_rate / 100);
                     $lineTotal = ($finalPrice + $taxAmount) * $quantity;
                     $order_discount += $discount * $quantity;
                     $order_taxes += $taxAmount * $quantity;
                     $subtotal += $finalPrice * $quantity;
                     $tax += $taxAmount * $quantity;

                     $itemsData[] = [
                         'product_id'    => $product->id,
                         'price'    => $basePrice,
                         'subtotal'   => $finalPrice,
                         'tax_amount'    => $taxAmount,
                         'quantity'      => $quantity,
                         'discount'      => $discount,
                         'total'         => $lineTotal,
                         'offer_id'  =>$hasOffer?->id
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
                     'subtotal'         => $subtotal,
                     'tax'              => $tax,
                     'order_discount'   => $order_discount ,
                     'order_taxes'      => $order_taxes ,
                     'total'            => $subtotal + $tax,
                     'paid_from_wallet' => 0,
                     'paid_by_card'     => 0,
                     'earned_points'    => $earnedPoints,
                     'is_paid'          => false,
                     'payment_type'     => 'cash',
                     'due_date'         => now()->addDays(7),
                     'paid_amount'      => 0,
                     'remaining_amount' => $subtotal + $tax,
                 ]);
                 $total += $order->total;
                 $order->items()->createMany($itemsData);

                 $this->addEarnedPointsToWallet( $order);

                 $orders[] = $order;
             }

             $cart->items()->delete();
             $master_order->update(['total' => $total]);
             if($request->filled('code')){
               $this->couponApply($request->code, $master_order);
             }

             $this->applyShip($request->shipping_type ,$request->shipping_address, $master_order);


               DB::commit();
               return $master_order;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    ///////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////

      public function couponApply(string $code, MasterOrder $master_order)
      {
        try {
            $coupon = Coupon::where('code', $code)->first();

            if (!$coupon || !$coupon->isValid()) {
                throw ValidationException::withMessages([
                    'code' => [__('lang.the discount code not valid or expired !')]
                ]);
            }

            $order = $master_order->orders()
                ->where('pharmacy_id', $coupon->pharmacy_id)
                ->first();

            if (!$order) {
                throw ValidationException::withMessages([
                    'code' => [__('lang.no order found for this coupon')]
                ]);
            }

            $order->coupon_id = $coupon->id;
            $result = $this->calculateDiscount($coupon, $order->total);
            $order->coupon_discount = $result["discount"];
            $order->total = $result["final_total"];
            $order->save();

            $master_order->total = abs($master_order->total) - abs($result["discount"]);
            $master_order->save();

            $coupon->increment('usage_times');

            return true;

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new \Exception(__('lang.unexpected_error') . ': ' . $e->getMessage());
        }
      }

    //////////////////////////////////////////////////////////////////////////
      public function applyShip($shipping_type, $shipping_address ,$master_order)
      {
       try {

           $address = UserAddress::find($shipping_address);

           if (!$address) {
               throw ValidationException::withMessages([
                   'shipping_address' => [__('lang.shipping address not found')]
               ]);
           }
           $orders = $master_order->orders;

           if ($orders->isEmpty()) {
               throw ValidationException::withMessages([
                   'orders' => [__('lang.no orders found for shipping')]
               ]);
           }

           foreach ($orders as $order) {
               $pharmacyId = $order->pharmacy_id;

               $shipping = Shipping::where('type', $shipping_type)
                                   ->where('pharmacy_id', $pharmacyId)
                                   ->first();

               if (!$shipping) {
                   throw ValidationException::withMessages([
                       'shipping_type' => [__("lang.this shipping not available for pharmacy ID: ") . $pharmacyId]
                   ]);
               }

               $order->shipping_id = $shipping->id;
               $order->shipping_cost = $shipping->value;
               $order->shipping_address = $address->full_address;


               $order->total = $order->total + abs($shipping->value);
               $order->save();

               $master_order = $order->master_order;
               $master_order->total = abs($master_order->total) + abs($shipping->value);
               $master_order->save();

           }

           return true;

       } catch (ValidationException $e) {
           throw $e; // كود 422
       } catch (\Exception $e) {
           throw new \Exception(__('lang.unexpected_error') . ': ' . $e->getMessage());
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
      public function addEarnedPointsToWallet( $order)
      {
          if (!$order->earned_points || $order->earned_points <= 0) {
              return;
          }

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

          } catch (\Exception $e) {
              throw $e;
          }
      }
       //////////////////////////////////////////////////////////////

     protected function validateCouponOrFail(string $code, $cart)
     {
         $coupon = Coupon::where('code', $code)->first();

         if (!$coupon || !$coupon->isValid()) {
             throw ValidationException::withMessages([
                 'code' => [__('lang.the discount code not valid or expired !')]
             ]);
         }

         $pharmacyIdsInCart = $cart->items->pluck('product.pharmacy_id')->unique();

         if (!$pharmacyIdsInCart->contains($coupon->pharmacy_id)) {
             throw ValidationException::withMessages([
                 'code' => [__('lang.this coupon is not valid for your current cart items')]
             ]);
         }

         return $coupon;
     }
    /////////////////////////////////////////////////////////////////////////////
      protected function validateShippingAvailableOrFail(string $shipping_type, int $shipping_address_id, $cart)
      {
          if (!$cart || $cart->items->isEmpty()) {
              throw ValidationException::withMessages([
                  'cart' => [__('lang.cart is empty')]
              ]);
          }

          $pharmacyIdsInCart = $cart->items->pluck('product.pharmacy_id')->unique();

          foreach ($pharmacyIdsInCart as $pharmacyId) {
              $shipping = Shipping::where('type', $shipping_type)
                                  ->where('pharmacy_id', $pharmacyId)
                                  ->first();

              if (!$shipping) {
                  throw ValidationException::withMessages([
                      'shipping_type' => [__('lang.this shipping not available for pharmacy ID: ') . $pharmacyId]
                  ]);
              }
          }

          $address = UserAddress::find($shipping_address_id);
          if (!$address) {
              throw ValidationException::withMessages([
                  'shipping_address' => [__('lang.invalid shipping address')]
              ]);
          }

          return true;
      }

}
