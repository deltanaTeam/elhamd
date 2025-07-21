<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProductRatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
          'user_name' => $this->user->name ?? 'User',
          'rate'      => $this->rate,
          'comment'   => $this->rate_text,
      ];
    }
}
