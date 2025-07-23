<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\{Cart,Order,Shipping,Coupon,OrderItem,CartItem,PointSetting,UserAddress};
use Exception;
use App\Services\OrderService;
use App\Http\Resources\{UserMasterOrderResource,MasterOrderResource};
use App\Models\MasterOrder;
use App\Http\Controllers\BaseController;
use Illuminate\Validation\ValidationException;
class OrderController extends Controller
{


    public function index()
    {
      try {
       $user = auth('client')->user();

       $masterOrders = MasterOrder::with('orders')->where('user_id',$user->id)->get();
       $data =  UserMasterOrderResource::collection($masterOrders);
       return JsonResponse::respondSuccess(__('lang.orders get successfully'),$data);


     } catch (\Exception $e) {
         return JsonResponse::respondError($e->getMessage());
     }
    }

    public function show($id)
    {
      try {
        $masterOrder = MasterOrder::with('orders')->findOrFail($id);
        $data = new MasterOrderResource($masterOrder);
        return JsonResponse::respondSuccess(__('lang.order get successfully'),$data);

      } catch (\Exception $e) {
          return JsonResponse::respondError($e->getMessage());
      }
    }

    public function store(Request $request, OrderService $orderService)
    {
        $request->validate([
            'code' => 'sometimes|string',
            'shipping_type' => 'required',
            'shipping_address' => 'required|exists:user_addresses,id',
        ]);

        try {
            $user = auth('client')->user();

            $masterOrder = $orderService->createOrder($user, $request);

            return JsonResponse::respondSuccess(__('lang.your order created successfully'), [
                'orders' => $masterOrder->orders->pluck('id'),
            ]);
        } catch (\Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }


}
