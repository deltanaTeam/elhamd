<?php

namespace App\Http\Resources;
use App\Http\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Services\OfferService;

class OfferProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $product = $this;
        $offer = $product->offer;

        $offerService = new OfferService();
        $result = $offerService->applyOffer($offer, $product->price, 1); // quantity = 1

        return [
            'product_id'    => $product->id,
            'name_ar' => $product->getTranslation('name',"ar") ,
            'name_en' => $product->getTranslation('name',"en") ,
            'generic_name_ar' => $product->getTranslation('generic_name',"ar") ,
            'generic_name_ar' => $product->getTranslation('generic_name',"en") ,
            'position' => $this->position,
            'active' => $this->active,
            'show_home' => $this->show_home,
            'description'   => $product->description,
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
            'imageUrl'      => $product?->getFirstMediaUrl(),
            'image'         => $product?->getFirstMedia()
                ? new MediaResource($product->getFirstMedia())
                : null,
        ];
    }
}
