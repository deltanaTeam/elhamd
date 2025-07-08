<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Pharmacy extends Model
{
  use HasTranslations;
  protected $table = 'pharmacies';
  public $translatable = ['name'];
  public function products()
  {
      return $this->hasMany(Product::class);
  }
}
