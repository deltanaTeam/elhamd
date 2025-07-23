<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\JsonResponse;

class Coupon extends BaseModel
{
  protected $guarded = ['id'];


  public function pharmacy()
  {
      return $this->belongsTo(Pharmacy::class);
  }



  // app/Models/Coupon.php

public function isValid(): array
{
    $now = now();

    if (!$this->is_active) {
        return ['valid' => false, 'message' => __('lang.the code is not activated')];
    }

    if ($this->start_date && $this->start_date > $now) {
        return ['valid' => false, 'message' => __('lang.the coupon has not started yet')];
    }

    if ($this->end_date && $this->end_date < $now) {
        return ['valid' => false, 'message' => __('lang.the coupon is finished')];
    }

    if ($this->usage_limit && $this->used_times >= $this->usage_limit) {
        return ['valid' => false, 'message' => __('lang.the maximum coupon has been used')];
    }

    if ($this->user_id && $this->user_id != $userId) {
        return ['valid' => false, 'message' => __('lang.the coupon is not intended for you')];
    }

    return ['valid' => true, 'message' => __('lang.the coupon is valid')];
}




}
