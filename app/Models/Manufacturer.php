<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends BaseModel
{
    protected $fillable = ["name","country"];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
