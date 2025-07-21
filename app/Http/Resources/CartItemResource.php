<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
          'product_id'     => $this->product_id,
          'name'           => $this->product->name,
          'base_price'     => $this->base_price,
          'final_price'    => $this->final_price,
          'tax_amount'     => $this->tax_amount,
          'quantity'       => $this->quantity,
          'total'          => $this->total,
          'free_quantity'  => $this->free_quantity ?? 0,
          'offer'          => $this->product->offer?->title,
      ];
    }
}
