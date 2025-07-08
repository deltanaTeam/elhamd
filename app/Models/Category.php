<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Category extends Model
{
  use HasTranslations;
  protected $table = 'categories';
  protected $fillable = ['name','description','parent_id'];
  public $translatable = ['name','description'];

  public function products()
  {
      return $this->belongsToMany(Product::class);
  }

  public function parent()
  {
      return $this->belongsTo(self::class,'parent_id');
  }
  public function children()
  {
      return $this->hasMany(self::class,'parent_id');
  }
}
