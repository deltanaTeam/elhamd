<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
          'product_id' => $this->product_id,
          'product_name' => $this->product?->name,
          'price' => $this->price,
          'discount' => $this->discount,
          'subtotal' => $this->subtotal,
          'tax_amount'=> $this->tax_amount,
          'quantity' => $this->quantity,
          'total' => $this->total
      ];
    }
}
