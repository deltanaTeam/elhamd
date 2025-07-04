<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Product extends Model
{
  use HasTranslations;
  protected $table = 'products';
  public $translatable = ['name'];
}
