<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyOrderResource extends JsonResource
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
          'pharmacy_id' => $this->pharmacy_id,
          'pharmacy_name' => $this->pharmacy?->name,
          'status' => $this->status,
          'order_discount' => $this->order_discount,
          'subtotal' => $this->subtotal,
          'coupon_discount' => $this->coupon_discount,
          'order_taxes' =>$this->order_taxes,
          'tax' =>$this->tax,
          'shipping_cost' => $this->shipping_cost ,
          'total' => $this->total,
          'paid_from_wallet' => $this->paid_from_wallet,
          'paid_by_card' => $this->paid_by_card,
          'is_paid' => $this->is_paid,
          'earned_points' => $this->earned_points,
          'shipping_address' => $this->shipping_address,
          'payment_type' => $this->payment_type,
          'due_date' => $this->due_date,
          'paid_amount' => $this->paid_amount,
          'remaining_amount' => $this->remaining_amount,
          'items'=> OrderItemResource::collection($this->items),


      ];
    }
}
