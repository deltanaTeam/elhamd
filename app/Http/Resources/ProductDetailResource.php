<?php

namespace App\Http\Resources;
use App\Http\Resources\MediaResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
          'id' => $this->id,
          'name_ar' => $this->getTranslation('name',"ar") ,
          'name_en' => $this->getTranslation('name',"en") ,
          'generic_name_ar' => $this->getTranslation('generic_name',"ar") ,
          'generic_name_ar' => $this->getTranslation('generic_name',"en") ,
          'type' => $this->type ,
          'form' => $this->form ,
          'strength' => $this->strength ,
          'price' => round($this->price, 2) ,
          'tax_rate' => $this->tax_rate ,
          'is_featured' => $this->is_featured ,
          'min_stock' => $this->min_stock ,
          'quantity' => $this->quantity ,
          'batch_number' => $this->batch_number ,
          'storage_conditions' => $this->storage_conditions ,
          'prescription_required' => $this->prescription_required ,
          'production_date' => $this->production_date ,
          'expiry_date' => $this->expiry_date ,
          'barcode' => $this->barcode ,
          'pack_size' => $this->pack_size ,
          'description' => $this->description,
          'position' => $this->position,
          'active' => $this->active,
          'show_home' => $this->show_home,
          'categoryName' => $this->category->name,
          'brandName' => $this->brand->name,
          'imageUrl' => $this->getFirstMediaUrlTeam(),
          'image' => new MediaResource($this->getFirstMedia()),
          'gallery' => $this->getMediaResource('gallery') ?: null,
          'createdAt' => $this->created_at ? $this->created_at->format('Y-M-d H:i:s A') : null,
          'updatedAt' => $this->updated_at ? $this->updated_at->format('Y-M-d H:i:s A') : null,
          'deletedAt' => $this->deleted_at ? $this->deleted_at->format('Y-M-d H:i:s A') : null,
          'deleted' => isset($this->deleted_at),
      ];
    }
}
