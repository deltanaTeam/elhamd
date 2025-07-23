<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
  protected $table = 'order_returns';
  protected $guarded = ['id'];

  
  public function pharmacy()
  {
      return $this->belongsTo(Pharmacy::class);
  }

}
