<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $guarded = ['id'];

    public function master_order()
    {
        return $this->belongsTo(MasterOrder::class);
    }
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function items()
    {
      $this->hasMany(OrderItem::class);
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }




}
