<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MediaResource;

class ProductResource extends JsonResource
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
            'position' => $this->position,
            'active' => $this->active,
            'price' => round($this->price, 2),
            'is_featured' => $this->is_featured ,
            'show_home' => $this->show_home,
            'description' => $this->description,
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
