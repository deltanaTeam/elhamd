<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $table = 'carts';
  protected $guarded = ['id'];
  public function items()
  {
      return $this->hasMany(CartItem::class);
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }
  // public function shipping()
  // {
  //     return $this->belongsTo(Shipping::class);
  // }


 //  public function calculateCouponDiscountForPharmacy(?string $couponCode, int $pharmacyId)
 // {
 //    if (!$couponCode) return ['value' => 0, 'type' => null, 'coupon' => null];
 //
 //    $coupon = Coupon::where('code', $couponCode)
 //        ->where('is_active', true)
 //        ->whereDate('start_date', '<=', now())
 //        ->whereDate('end_date', '>=', now())
 //        ->where('pharmacy_id', $pharmacyId)
 //        ->first();
 //
 //    if (!$coupon) return ['value' => 0, 'type' => null, 'coupon' => null];
 //
 //    if ($coupon->usage_limit !== null && $coupon->usage_times >= $coupon->usage_limit) {
 //        return ['value' => 0, 'type' => null, 'coupon' => null];
 //    }
 //
 //    // نفلتر المنتجات الخاصة بالصيدلية فقط
 //    $items = $this->items->filter(fn($item) => $item->product->pharmacy_id == $pharmacyId);
 //
 //    if ($items->isEmpty()) return ['value' => 0, 'type' => null, 'coupon' => null];
 //
 //    $subtotal = $items->sum(fn($item) => $item->final_price * $item->quantity);
 //
 //    $discount = match ($coupon->discount_type) {
 //        'percentage' => $subtotal * ($coupon->discount_value / 100),
 //        'fixed'      => $coupon->discount_value,
 //        default      => 0,
 //    };
 //
 //    return [
 //        'value'  => round(min($discount, $subtotal), 2),
 //        'type'   => $coupon->discount_type,
 //        'coupon' => $coupon
 //    ];





}
