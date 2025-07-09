<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandSuggestion extends Model
{
  use HasTranslations;
  protected $table = 'brands';
  public $translatable = ['name'];
}
