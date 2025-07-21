<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HasProfile;
use App\Models\User;

class ClientProfileController extends Controller
{
    use HasProfile;
    public function __construct()
    {
      $this->guard = 'client';
    }

    public function get(Request $request)
    {
      return $this->getProfile($request ,$this->guard);
    }

    public function update(Request $request)
    {
      return $this->updateProfile( $request, User::class ,$this->guard);
    }
}
