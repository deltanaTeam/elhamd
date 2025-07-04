<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Pharmacy extends Model
{
  use HasTranslations;
  protected $table = 'pharmacies';
  public $translatable = ['name'];
}
