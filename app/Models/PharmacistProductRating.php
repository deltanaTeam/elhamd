<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacistProductRating extends Model
{
  protected $table = 'pharmacist_product_ratings';
  public function pharmacist()
  {
      return $this->belongsTo(Pharmacist::class);
  }

}
