<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterProduct extends Model
{
    protected $guarded = ['id'];
    public $table = "master_products";

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_master_product');
    }

    public function activeIngredients()
    {
        return $this->belongsToMany(ActiveIngredient::class,'ingredient_master_product')
        ->withPivot('amount')->withTimestamps();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function codes()
    {
        return $this->hasMany(ProductCode::class);
    }
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

}
