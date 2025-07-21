<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;



class OfferBasicResource extends JsonResource
{

  public function toArray(Request $request): array
  {
      return [
          'id'            => $this->id,
          'type'          => $this->type,
          'discount_type' => $this->discount_type,
          'value'         => $this->value,
          'start_date'    => optional($this->start_date)->format('Y-m-d'),
          'end_date'      => optional($this->end_date)->format('Y-m-d'),
      ];
  }



}
