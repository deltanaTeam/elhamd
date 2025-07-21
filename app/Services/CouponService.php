<?php
namespace App\Services;

use App\Models\Coupon;
use Illuminate\Support\Carbon;

class CouponService
{
    public function validate(Coupon $coupon, float $subtotal): array
    {
        $now = Carbon::now();

        if (!$this->is_active) {
            return ['valid' => false, 'message' => __('lang.code_not_activated')];
        }

        if ($this->start_date && $this->start_date > $now) {
            return ['valid' => false, 'message' => __('lang.coupon_not_started')];
        }

        if ($this->end_date && $this->end_date < $now) {
            return ['valid' => false, 'message' => __('lang.coupon_finished')];
        }

        if ($this->usage_limit && $this->used_times >= $this->usage_limit) {
            return ['valid' => false, 'message' => __('lang.maximum_coupon_used')];
        }



        return ['valid' => true, 'message' => __('lang.discount_applied')];
        // حساب الخصم
        $discount = $this->calculateDiscount($coupon, $subtotal);
        $final = max(0, $subtotal - $discount);

        return [
            'valid' => true,
            'message' => __('lang.the coupon is applied successfully'),
            'discount' => $discount,
            'final_price' => $final,
        ];
    }

    protected function calculateDiscount(Coupon $coupon, float $subtotal): float
    {
        if ($coupon->discount_type === 'percentage') {
            return $subtotal * ($coupon->discount_value / 100);
        }

        if ($coupon->discount_type === 'fixed') {
            return min($coupon->discount_value, $subtotal);
        }

        return 0;
    }
}
