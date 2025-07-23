<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\SPA_Auth;

class ClientAuthController extends Controller
{

    use SPA_Auth;
    public function __construct()
    {
        $this->useGuard('client', User::class);
    }


    public function register(Request $request)
    {
      return  $this->publicRegister($request);
    }

    public function login(Request $request)
     {
         return $this->publicLogin($request);
     }

     public function forgotPassword(Request $request)
     {
         return $this->publicForgotPassword($request,"client");
     }

     public function resetPassword(Request $request)
     {
         return $this->publicResetPassword($request,"client");
     }

     public function invokeEmail(Request $request, $id, $hash)
     {
         return $this->publicInvokeEmail($request, $id, $hash);
     }

     public function resentEmail(Request $request)
     {
         return $this->publicResentEmail($request);
     }

     public function logout(Request $request)
     {
         return $this->publicLogout($request);
     }
}
