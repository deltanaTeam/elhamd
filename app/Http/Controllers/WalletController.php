<?php
namespace App\Http\Controllers;

use App\Models\{Wallet, WalletTransaction, Point, Order};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    // احسب قيمة النقاط المتاحة للمستخدم
    public function redeemableValue()
    {
        $wallet = Wallet::where('user_id', Auth::guard('client')->id())->first();

        if (!$wallet || $wallet->point_balance <= 0) {
            return response()->json([
                'value' => 0,
                'points' => 0,
            ]);
        }

        $pointSetting = Point::where('type', 'earned')
            ->where('user_id', Auth::guard('client')->id())
            ->where('is_active', 1)
            ->latest()
            ->first();

        $redeemRate = $pointSetting?->redeem_rate ?? 0.5; // fallback

        return response()->json([
            'points' => $wallet->point_balance,
            'value' => $wallet->point_balance * $redeemRate,
        ]);
    }

    // استخدام النقاط للدفع في طلب معين
    public function usePointsInOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'points_to_use' => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            $wallet = Wallet::where('user_id', Auth::id())->lockForUpdate()->firstOrFail();

            if ($wallet->point_balance < $request->points_to_use) {
                return response()->json(['message' => 'Not enough points'], 400);
            }

            $pointSetting = Point::where('type', 'earned')
                ->where('user_id', Auth::id())
                ->where('is_active', 1)
                ->latest()
                ->first();

            $redeemRate = $pointSetting?->redeem_rate ?? 0.5;
            $amount = $request->points_to_use * $redeemRate;

            // خصم النقاط من المحفظة
            $wallet->decrement('point_balance', $request->points_to_use);
            $wallet->decrement('balance', $amount);

            // تسجيل الحركة
            WalletTransaction::create([
                'wallet_id'   => $wallet->id,
                'type'        => 'withdraw',
                'amount'      => $amount,
                'description' => 'استخدام النقاط في الطلب',
                'order_id'    => $request->order_id,
            ]);

            // تعديل الطلب نفسه
            $order = Order::findOrFail($request->order_id);
            $order->paid_from_wallet += $amount;
            $order->paid_amount += $amount;
            $order->remaining_amount = max($order->total - $order->paid_amount, 0);
            $order->save();

            return response()->json(['message' => 'تم استخدام النقاط بنجاح', 'amount_used' => $amount]);
        });
    }

    // بعد شراء الطلب بنجاح -> اكسب نقاط
    public function earnPoints(Order $order)
    {
        $total = $order->total;

        $pointSetting = Point::where('type', 'earned')
            ->where('user_id', Auth::id())
            ->where('is_active', 1)
            ->latest()
            ->first();

        $earningRate = $pointSetting?->earning_rate ?? 1;

        $points = floor($total * $earningRate); // مثلاً 100 جنيه * 1 = 100 نقطة

        $wallet = Wallet::firstOrCreate([
            'user_id'     => Auth::id(),
            'pharmacy_id' => $order->pharmacy_id,
        ], [
            'balance'       => 0,
            'point_balance' => 0,
        ]);

        $wallet->increment('point_balance', $points);

        WalletTransaction::create([
            'wallet_id'   => $wallet->id,
            'type'        => 'earn_points',
            'amount'      => 0,
            'description' => 'كسب نقاط من طلب #' . $order->id,
            'order_id'    => $order->id,
        ]);

        Point::create([
            'type'          => 'earned',
            'amount'        => $points,
            'source_name'   => 'طلب #' . $order->id,
            'pharmacy_id'   => $order->pharmacy_id,
            'user_id'       => Auth::id(),
            'earning_rate'  => $earningRate,
            'redeem_rate'   => $pointSetting?->redeem_rate ?? 0.5,
        ]);

        return response()->json(['message' => 'تم إضافة النقاط للمحفظة', 'points' => $points]);
    }
}
