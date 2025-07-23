<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
  protected $table = 'cart_items';
  protected $guarded = ['id'];
  public function cart()
   {
       return $this->belongsTo(Cart::class);
   }

   public function product()
   {
       return $this->belongsTo(Product::class);
   }

   public function getBasePriceAttribute()
   {
       return $this->product->price;
   }

   public function getFinalPriceAttribute()
   {
       $price = $this->product->price;
       $offer = $this->product->offer;

       if ($offer) {
           if ($offer->type === 'discount') {
               if ($offer->discount_type === 'percentage') {
                   $price -= ($price * ($offer->value / 100));
               } elseif ($offer->discount_type === 'fixed') {
                   $price -= $offer->value;
               }
           }
       }

       return max($price, 0);
   }

   public function getTaxAmountAttribute()
   {
       $rate = $this->product->tax_rate;
       return $this->final_price * ($rate / 100);
   }


    public function getTotalAttribute()
    {
        return ($this->final_price + $this->tax_amount) * $this->quantity;
    }

    public function getFreeQuantityAttribute()
    {
        $offer = $this->product->offer;

        if (
            $offer &&
            $offer->type === 'extra' &&
            $this->quantity >= $offer->min_quantity
        ) {
            $sets = intdiv($this->quantity, $offer->min_quantity);
            return $sets * $offer->value;
        }

        return 0;
    }


}
