<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id' => $this->id ,
          'position' => $this->position ,
          'name_ar' => $this->getTranslation('name',"ar") ,
          'name_en' => $this->getTranslation('name',"en") ,
          'show_home' => $this->show_home,
          'imageUrl' => $this->getFirstMediaUrlTeam(),
          'image' => new MediaResource($this->getFirstMedia()),
          'createdAt' => $this->created_at ? $this->created_at->format('Y-M-d H:i:s A') : null,
          'updatedAt' => $this->updated_at ? $this->updated_at->format('Y-M-d H:i:s A') : null,
          'deletedAt' => $this->deleted_at ? $this->deleted_at->format('Y-M-d H:i:s A') : null,
          'deleted' => isset($this->deleted_at),

        ];
    }
}
