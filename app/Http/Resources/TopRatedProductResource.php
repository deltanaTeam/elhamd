<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MediaResource;
use App\Http\Resources\OfferBasicResource;

class TopRatedProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
         'product_id'   => $this->id,
         'name_ar' => $this->getTranslation('name',"ar") ,
         'name_en' => $this->getTranslation('name',"en") ,
         'generic_name_ar' => $this->getTranslation('generic_name',"ar") ,
         'generic_name_ar' => $this->getTranslation('generic_name',"en") ,
         'position' => $this->position,
         'active' => $this->active,
         'show_home' => $this->show_home,
         'description'  => $this->description,
         'price'        => round($this->price, 2),
         'average_rating' => round($this->ratings_avg_rate ?? 0, 1),
         'imageUrl' => $this->getFirstMediaUrlTeam(),
         'image' => new MediaResource($this->getFirstMedia()),
         'offer'        => $this->offer
             ? new OfferBasicResource($this->offer)
             : null,
     ];
    }
}
