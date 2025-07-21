<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopRatedBrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
          'brand_id'        => $this->id,
          'name'            => $this->name,
          'average_rating' => [
              'user' => round($this->ratings_avg_rate, 2),
              'pharmacist' => round($this->pharmacist_ratings_avg_rate, 2),
          ],
          'products_count'  => $this->products_count,
          'imageUrl' => $this->getFirstMediaUrlTeam(),
          'image' => new MediaResource($this->getFirstMedia()),
      ];
    }
}
