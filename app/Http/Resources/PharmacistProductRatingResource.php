<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacistProductRatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
         'pharmacist_name' => $this->pharmacist->name ?? 'Pharmacist',
         'rate'            => $this->rate,
         'comment'         => $this->rate_text,
     ];
    }
}
