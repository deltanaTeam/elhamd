<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function items()
    {
      $this->hasMany(OrderItem::class);
    }
    // public function getDistributedDiscounts()
    // {
    //   $discounts = [];
    //   $totalBeforDiscount = $this->items->sum(function($item){
    //     return $this->price * $item->quantity;
    //   });
    //   if ($this->discount && $totalBeforDiscount >0) {
    //     foreach ($this->items as  $item) {
    //       $itemTotal = $item->price * $item->quantity;
    //       $itemShare = $itemTotal /$totalBeforDiscount;
    //       $itemDiscountTotal =$this->discount * $itemShare;
    //       $unitDiscount = $itemDiscountTotal /$item->quantity;
    //       $discounts[$item->id] = round($unitDiscount,2);
    //     }
    //   }
    //   return $discounts;
    // }
}
