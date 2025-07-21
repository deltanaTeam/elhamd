<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Carbon;
use App\Models\Coupon;
use App\Models\Offer;

class OfferService
{
    /**
     * حساب السعر بعد العرض والكوبون
     */
    public function applyOffer(?Offer $offer, float $unitPrice, int $quantity): array
    {
        $originalTotal = $unitPrice * $quantity;
        $discount = 0;
        $message = [];

        //  تطبيق العرض
        if ($offer && $offer->is_active && $this->isOfferActiveNow($offer)) {
            if ($offer->type === 'discount') {
                $offerDiscount = $this->calculateOfferDiscount($offer, $unitPrice, $quantity);
                $discount += $offerDiscount;
                $message[] = __('lang.discount_applied');
            }

            if ($offer->type === 'extra' && $quantity >= $offer->min_quantity) {

                $freeQty = intdiv($quantity, $offer->min_quantity);
                $offerDiscount = $freeQty * $unitPrice;
                $discount += $offerDiscount;
                $message[] = __('lang.get_free_piece_applied');
            }
        }



        $finalTotal = max(0, $originalTotal - $discount);

        return [
            'original_price' => $originalTotal,
            'final_price' => $finalTotal,
            'total_discount' => $discount,
            'message' => implode(' + ', $message),
        ];
    }

    protected function calculateOfferDiscount(Offer $offer, float $unitPrice, int $quantity): float
    {
        if ($offer->discount_type === 'percentage') {
            return ($unitPrice * $quantity) * ($offer->value / 100);
        }

        if ($offer->discount_type === 'fixed') {
            return $offer->value;
        }

        return 0;
    }

    protected function isOfferActiveNow(Offer $offer): bool
    {
        $now = now();

        return (!$offer->start_date || $offer->start_date <= $now) &&
               (!$offer->end_date || $offer->end_date >= $now);
    }




}
