<?php
namespace App\Http\Controllers\Pharmacy\Web;

use App\Http\Controllers\Controller;
use App\Traits\WebAuth;
use App\Models\Pharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\URL;
use App\Notifications\VerifyEmailCustom;
use App\Notifications\PharmacistResetPasswordNotification;

class PharmacistAuthController extends Controller
{
  use WebAuth;

  public function __construct()
  {
      $this->useGuard('pharmacist', Pharmacist::class);
  }
  public function showLoginForm()
  {
      return view('pharmacist.auth.login');
  }

  public function showRegisterForm()
  {
      return view('pharmacist.auth.register');
  }

  public function showForgotPasswordForm()
  {
      return view('pharmacist.auth.forgot-password');
  }

  public function showResetPasswordForm(Request $request, $token)
  {
      return view('pharmacist.auth.reset-password', [
          'token' => $token,
          'email' => $request->email,
      ]);
  }

  public function register(Request $request)
  {
      return $this->publicRegister($request ,0);
  }

  public function login(Request $request)
  {
      return $this->publicLogin($request);
  }

  public function forgotPassword(Request $request )
  {
    $request->validate(['email' => 'required|email']);

    $user = Password::broker("pharmacist")->getUser($request->only('email'));

    if (!$user) {
        return back()->withErrors(['email' => __('No user found with that email address.')]);
    }

    $token = Password::broker("pharmacist")->createToken($user);

    $user->notify(new PharmacistResetPasswordNotification($token, $user->email));

    return back()->with('status', 'We have emailed your password reset link!');
    //  return $this->publicForgotPassword($request ,'pharmacist');
  }

  public function resetPassword(Request $request)
  {
      return $this->publicResetPassword($request ,'pharmacist') ;
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
