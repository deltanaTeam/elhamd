<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
  use SoftDeletes;

  protected $guarded = ['id'];


  public function pharmacy()
  {
      return $this->belongsTo(Pharmacy::class);
  }

}
