<?php

namespace App\Http\Resources;
use App\Http\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Services\OfferService;

class OfferResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $product = $this;
        $offer = $product->offer;

        $offerService = new OfferService();
        $result = $offerService->applyOffer($offer, $product->price, 1); // quantity = 1
        $taxes = [];
        if($product->tax_rate > 0 && $product->offer){
          $taxes['tax_rate']= $product->tax_rate;
          $taxes['tax_value'] = round(($result['final_price'] * $product->tax_rate) / 100, 2);
          $taxes['price_with_tax']= round($result['final_price'] + $taxes['tax_value'], 2);
        }else if($product->tax_rate > 0){

            $taxes['tax_rate'] = $product->tax_rate;
            $taxes['tax_value'] = round($product->tax_value, 2);
            $taxes['price_with_tax']= round($product->price_with_tax, 2);

        }
        return [
            'product_id'    => $product->id,
            'offer_title'  => $offer ?->title  ,
            'price_before'  => round($product->price, 2),
            'price_after'   => round($result['final_price'], 2),

            'discount'      => round($result['total_discount'], 2),
            'discount_percentage' => $product->price > 0
                ? round(($result['total_discount'] / $product->price) * 100, 2)
                : 0,
            'offer_period'  => $offer ? [
                'start_date' => $offer->start_date ? Carbon::parse($offer->start_date)->format('Y-m-d') : null,
                'end_date'   => $offer->end_date ? Carbon::parse($offer->end_date)->format('Y-m-d') : null,
            ] : null,
            'tax'=>$taxes,

        ];
    }
}
