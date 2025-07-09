<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyProduct extends Model
{
  protected $table = 'pharmacy_products';

  public function pharmacy()
  {
      return $this->belongsTo(Pharmacy::class);
  }


}
