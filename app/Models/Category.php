<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Category extends Model
{
  use HasTranslations;
  protected $table = 'categories';
  public $translatable = ['name'];

  public function products()
  {
      return $this->belongsToMany(Product::class);
  }

  public function parent()
  {
      return $this->belongsTo(Category::class,'parent_id');
  }
  public function children()
  {
      return $this->hasMany(Category::class,'parent_id');
  }
}
