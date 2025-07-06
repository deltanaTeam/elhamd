<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasMedia;
use Spatie\Translatable\HasTranslations;
class Product extends Model
{
  use HasTranslations;
  use HasMedia;

  protected $table = 'products';
  public $translatable = ['name'];

   protected $with = [
       'media',
   ];

   protected $guarded = ['id'];

   public function categories()
   {
       return $this->belongsToMany(Category::class);
   }

   public function brand()
   {
       return $this->belongsTo(Brand::class);
   }

   public function pharmacies()
   {
       return $this->belongsToMany(Pharmacy::class, 'pharmacy_products')
           ->withPivot('price', 'quantity')
           ->withTimestamps();
   }

   public function pharmacyProducts()
   {
       return $this->hasMany(PharmacyProduct::class);
   }

   public function favoredByUsers()
   {
       return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
   }
}
