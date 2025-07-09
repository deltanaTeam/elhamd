<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySuggestion extends Model
{
  use HasTranslations;
  protected $table = 'categories';
  protected $fillable = ['name','description','parent_id','image'];
  public $translatable = ['name','description'];
}
