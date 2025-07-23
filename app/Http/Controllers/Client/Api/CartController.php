<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Models\Cart;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CartItemResource;
use App\Interfaces\Client\CartRepositoryInterface;
use App\Repositories\Client\CartRepository;
use App\Http\Controllers\BaseController;
class CartController extends BaseController
{


    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $cart = Cart::firstOrCreate([
                    'user_id' => auth('client')->id()
                ]);
        try {
           $cart->load('items.product.offer');

           $items = CartItemResource::collection($cart->items);

            if (!$cart || $cart->items->isEmpty()) {
                return JsonResponse::respondError(__('lang.Cart is empty'));
            }

            $summary = [
                'subtotal' =>  round( $cart->items->sum('final_price'),2),
                'tax'      => round( $cart->items->sum('tax_amount'),2),
                'total'    => round( ($cart->items->sum('total') ),2),
                'count_items' => count($items)

            ];
            $data =[
                'items'    => $items,
                'summary' => $summary
            ];
            return JsonResponse::respondSuccess(__('lang.cart get successfully'),$data);

        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }



    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
     {
         $user = auth('client')->user();

         $validator = Validator::make($request->all(), [
             'product_id' => 'required|exists:products,id',
             'quantity' => 'required|integer|min:1',
         ]);

         if ($validator->fails()) {
             return JsonResponse::respondError($validator->errors()->first());
         }

         try {
             $cart = $user->cart()->firstOrCreate([
                 'user_id' => $user->id
             ]);

             $existingItem = $cart->items()->where('product_id', $request->product_id)->first();

             if ($existingItem) {
                 $existingItem->quantity += $request->quantity;
                 $existingItem->save();
             } else {
                 $cart->items()->create([
                     'product_id' => $request->product_id,
                     'quantity' => $request->quantity,
                 ]);
             }

             return JsonResponse::respondSuccess('Cart Item Added Successfully');

         } catch (Exception $e) {
             return JsonResponse::respondError($e->getMessage());
         }
     }




    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, string $id)
     {
         $user = auth('client')->user();

         $validator = Validator::make($request->all(), [
             'quantity' => 'required|integer|min:1',
         ]);

         if ($validator->fails()) {
             return JsonResponse::respondError($validator->errors()->first());
         }

         try {
             $cart = $user->cart()->with('items')->first();

             if (!$cart) {
                 return JsonResponse::respondError(__("lang.Cart Doesn't Exist."));
             }

             $item = $cart->items()->where('id', $id)->first();

             if (!$item) {
                 return JsonResponse::respondError(__("lang.Item Doesn't in Cart"));
             }

             $item->update([
                 'quantity' => $request->quantity,
             ]);

             return JsonResponse::respondSuccess(__('lang.Quantity Updated Successfully'));

         } catch (Exception $e) {
             return JsonResponse::respondError($e->getMessage());
         }
     }


    /**
     * Remove the specified resource from storage.
     */
     public function destroy(string $id)
     {
         $user = auth('client')->user();

         try {
             $cart = $user->cart()->with('items')->first();

             if (!$cart) {
               return JsonResponse::respondError(__("lang.Cart Doesn't Exist."));
             }

             $item = $cart->items()->where('id', $id)->first();

             if (!$item) {
               return JsonResponse::respondError(__("lang.Item Doesn't in Cart"));
             }

             $item->delete();

             return JsonResponse::respondSuccess(__('lang.Item Deleted Successfully'));

         } catch (Exception $e) {
             return JsonResponse::respondError($e->getMessage());
         }
     }

     /**
        * apply  a customer coupon in cart .
        */

     //////////////////////////////////////////////////////////////////////




}
