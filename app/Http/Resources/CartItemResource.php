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
       $product = $this->product;
      return [
          'product_id'     => $this->product_id,
          'name'           => $this->product->name,
          'base_price'     => round($this->base_price,2),
          'final_price'    => round( $this->final_price,2),
          'tax_amount'     => $this->tax_amount,
          'quantity'       => $this->quantity,
          'total'          => round($this->total,2),
          'free_quantity'  => $this->free_quantity ?? 0,
          'offer'          => $product->offer ? new OfferResource($product) : null,
      ];
    }
}
