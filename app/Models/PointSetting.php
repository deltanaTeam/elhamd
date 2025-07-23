<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointSetting extends Model
{
  protected $fillable = [
      'pharmacy_id', 'earning_rate', 'redeem_rate', 'is_active',
  ];

  public function pharmacy()
  {
      return $this->belongsTo(Pharmacy::class);
  }
}
