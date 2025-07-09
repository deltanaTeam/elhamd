<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = ["name","country"];

    public function masterProducts()
    {
        return $this->hasMany(MasterProduct::class);
    }
}
