<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
  use HasTranslations;
  use HasMedia ,SoftDeletes;
  protected $table = 'pharmacies';
  public $translatable = ['name'];
  protected $with = [
      'media',
   ];

  protected $guarded = ['id'];

  public function products()
  {
      return $this->hasMany(Product::class);
  }
}
