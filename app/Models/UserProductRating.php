<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProductRating extends Model
{
  protected $table = 'user_product_ratings';

  public function user()
  {
      return $this->belongsTo(User::class);
  }

}
