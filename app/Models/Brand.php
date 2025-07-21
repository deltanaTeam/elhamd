<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
class Brand extends BaseModel
{
    use HasMedia ,SoftDeletes;
    use HasTranslations;
    protected $with = [
        'media',
    ];
    public $translatable = ['name'];

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
