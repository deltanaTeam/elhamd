<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public $table = "offers";
    protected $guarded = ['id'];
    // public function owner()
    // {
    //     return $this->morphTo();
    // }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
