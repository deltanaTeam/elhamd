<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MediaResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
<<<<<<< HEAD
            'product_code' => $this->productCode,
            'pharmacy' => $this->pharmacy,
            'price' => $this->price,
            'tax_rate' => $this->tax_rate,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'min_stock' => $this->min_stock,
            'quantity' => $this->quantity,
            'batch_number' => $this->batch_number,
            'storage_conditions' => $this->storage_conditions,
            'prescription_required' => $this->prescription_required,
            'production_date' => $this->production_date,
            'expiry_date' => $this->expiry_date,
            'images' => $this->images,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
=======
            'name_ar' => $this->getTranslation('name',"ar") ,
            'name_en' => $this->getTranslation('name',"en") ,
            'generic_name' => $this->generic_name,
            'position' => $this->position,
            'active' => $this->active,
            'price' => round($this->price, 2),
            'is_featured' => $this->is_featured ,
            'show_home' => $this->show_home,
            'average_rating' => [
                'user' => round($this->ratings_avg_rate, 2),
                'pharmacist' => round($this->pharmacist_ratings_avg_rate, 2),
            ],
            'imageUrl' => $this->getFirstMediaUrlTeam(),
            'image' => new MediaResource($this->getFirstMedia()),

>>>>>>> 69d2a7c008f6b2107a416cfcf2fa1251506f8b70
        ];
    }
}