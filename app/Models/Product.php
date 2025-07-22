<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasMedia;
use Spatie\Translatable\HasTranslations;
class Product extends BaseModel
{
  use HasTranslations;
  use HasMedia;

  protected $table = 'products';
  public $translatable = ['name','description','type','form'];
   protected $with = [
       'media',
   ];

   protected $guarded = ['id'];

   public function offer()
  {
      return $this->hasOne(Offer::class)->where('is_active', true)
                 ->where(function ($query) {
                     $now = now();
                     $query->whereNull('start_date')
                           ->orWhere('start_date', '<=', $now);
                 })
                 ->where(function ($query) {
                     $now = now();
                     $query->whereNull('end_date')
                           ->orWhere('end_date', '>=', $now);
                 });
  }
   public function brand()
   {
       return $this->belongsTo(Brand::class);
   }

   public function manufacturer()
   {
       return $this->belongsTo(Manufacturer::class);
   }

   public function category()
   {
       return $this->belongsTo(Category::class);
   }

   public function pharmacy()
   {
       return $this->belongsTo(Pharmacy::class);
   }

 

   // تقييمات الصيادلة
   public function pharmacistRatings()
   {
       return $this->hasMany(PharmacistProductRating::class);
   }

   public function orderItems()
   {
       return $this->hasMany(OrderItem::class);
   }


   public function getUserRatingAvgAttribute()
   {
       return round($this->ratings()->avg('rate'), 2);
   }

   public function getPharmacistRatingAvgAttribute()
   {
       return round($this->pharmacistRatings()->avg('rate'), 2);
   }

   public function getTaxValueAttribute()
  {
      return ($this->price * $this->tax_rate) / 100;
  }

  




  
  public function getPriceWithTaxAttribute()
  {
      return $this->price + $this->tax_value;
  }
// public function productCode()
// {
//     return $this->hasOne(ProductCode::class); 


// }



public function ratings()
{
    return $this->hasMany(ProductRating::class);
}

public function approvedRatings()
{
    return $this->ratings()->where('is_approved', true);
}

public function recalculateRatings()
{
    $approvedRatings = $this->approvedRatings();
    
    $this->update([
        'ratings_count' => $approvedRatings->count(),
        'average_rating' => $approvedRatings->avg('rating'),
        'rating_breakdown' => $approvedRatings
            ->selectRaw('rating, count(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray()
    ]);
}



}
