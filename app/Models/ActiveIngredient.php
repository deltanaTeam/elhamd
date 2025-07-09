<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveIngredient extends Model
{
    protected $fillable = ["name"];

    public function masterProducts()
    {
        return $this->belongsToMany(MasterProduct::class,'ingredient_master_product')
        ->withPivot('amount')->withTimestamps();
    }
}
