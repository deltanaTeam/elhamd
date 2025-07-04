<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class ProductInfo extends Model
{
  use HasTranslations;
  protected $table = 'product_infos';
  public $timestamps = false;
  public $translatable = ['name'];
}
