<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MasterOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      /// this resource from master order
      return [
          'id' => $this->id,
          'user_id' => $this->user_id,
          'user_name' => $this->user?->name ,
          'total' => $this->total ,
          'status' => __("lang.{$this->status}"),
          'createdAt' => $this->created_at ? $this->created_at->format('Y-M-d H:i:s A') : null,
          'updatedAt' => $this->updated_at ? $this->updated_at->format('Y-M-d H:i:s A') : null,
          'orders' => PharmacyOrderResource::collection($this->orders),


      ];
    }
}
