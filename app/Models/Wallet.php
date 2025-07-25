<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
  protected $table = 'wallets';
  protected $guarded = ['id'];


  public function user()
  {
      return $this->belongsTo(User::class);
  }


  public function pharmacy()
  {
      return $this->belongsTo(Pharmacy::class);
  }



}
