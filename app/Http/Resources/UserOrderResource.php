<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderResource extends JsonResource
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
          'pharmacy_name' => $this->pharmacy?->name,
          'status' => $this->status,
          'total' => $this->total,
          'is_paid' => $this->is_paid,



      ];
    }
}
