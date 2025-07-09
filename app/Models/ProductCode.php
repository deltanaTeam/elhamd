<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCode extends Model
{
  public $table = "product_codes";
  protected $guarded = ["id"];

  public function masterProducts()
  {
      return $this->belongsTo(MasterProduct::class);
  }

  public function Products()
  {
      return $this->hasMany(Product::class);
  }
}
