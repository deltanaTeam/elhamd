<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
   use HasMedia ,SoftDeletes;
   use HasTranslations;
   protected $with = [
       'media',
    ];
    public $translatable = ['name','reason'];

    protected $casts = [
        'active' => 'boolean',
        'show_home' => 'boolean',
    ];
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
