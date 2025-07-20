<?php
namespace App\Http\Controllers\Pharmacy\Web;

use App\Http\Controllers\Controller;
use App\Traits\WebAuth;
use App\Models\Pharmacist;
use Illuminate\Http\Request;
class PharmacistAuthController extends Controller
{
  use WebAuth;

  public function __construct()
  {
      $this->useGuard('pharmacist', Pharmacist::class);
  }
  public function showLoginForm()
  {
      return view('auth.login');
  }

  public function showRegisterForm()
  {
      return view('auth.register');
  }

  public function showForgotPasswordForm()
  {
      return view('auth.forgot-password');
  }

  public function showResetPasswordForm(Request $request, $token)
  {
      return view('auth.reset-password', [
          'token' => $token,
          'email' => $request->email,
      ]);
  }

  public function register(Request $request)
  {
      return $this->publicRegister($request);
  }

  public function login(Request $request)
  {
      return $this->publicLogin($request);
  }

  public function forgotPassword(Request $request)
  {
      return $this->publicForgotPassword($request);
  }

  public function resetPassword(Request $request)
  {
      return $this->publicResetPassword($request);
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
