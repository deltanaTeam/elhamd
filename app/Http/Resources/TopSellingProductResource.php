<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopSellingProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
          'product_id'     => $this->id,
          'name_ar' => $this->getTranslation('name',"ar") ,
          'name_en' => $this->getTranslation('name',"en") ,
          'generic_name_ar' => $this->getTranslation('generic_name',"ar") ,
          'generic_name_ar' => $this->getTranslation('generic_name',"en") ,
          'description'    => $this->description,
          'position' => $this->position,
          'active' => $this->active,
          'show_home' => $this->show_home,
          'price'          => round($this->price, 2),
          'total_sold'     => $this->order_items_sum_quantity ?? 0,
          'imageUrl' => $this->getFirstMediaUrlTeam(),
          'image' => new MediaResource($this->getFirstMedia()),
          'offer'          => $this->offer
              ? new OfferBasicResource($this->offer)
              : null,
      ];
    }
}
