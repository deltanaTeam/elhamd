<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMedia;

class ProductImage extends Model
{
  use HasMedia;
  protected $with = [
      'media',
  ];
}
