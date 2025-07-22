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
            // 'product_code' => $this->productCode,
            'name' => $this->name,
            'pharmacy' => new PharmacyResource($this->pharmacy), 
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
            'images' => $this->getMedia('images')->map(function ($media) {
                return $media->getUrl();  // استرجاع رابط الصورة
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}