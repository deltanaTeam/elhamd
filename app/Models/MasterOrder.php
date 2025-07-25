<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterOrder extends Model
{
      protected $guarded = ['id'];
      public function user()
      {
          return $this->belongsTo(User::class);
      }
      public function orders()
      {
          return $this->hasMany(Order::class);
      }
}
