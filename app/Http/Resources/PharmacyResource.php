<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MediaResource;
class PharmacyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'        => $this->id,
            'name_ar' => $this->getTranslation('name',"ar") ,
            'name_en' => $this->getTranslation('name',"en") ,
            'address'   => $this->address,
            'phone'     => $this->phone,
            'imageUrl'      => $this?->getFirstMediaUrl(),
            'image' => new MediaResource($this->getFirstMedia()),
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i'),


        ];
    }
}
