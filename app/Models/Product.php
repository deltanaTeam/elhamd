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

   protected $with = [
       'media',
   ];

   protected $guarded = ['id'];

   // public function owner()
   // {
   //     return $this->morphTo();
   // }

   public function code()
   {
       return $this->belongsTo(ProductCode::class);
   }

   public function pharmacy()
   {
       return $this->belongsTo(Pharmacy::class);
   }






}
