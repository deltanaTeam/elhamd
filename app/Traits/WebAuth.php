<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Notifications\VerifyEmailCustom;

trait WebAuth
{
    protected string $guard = 'web';
    protected string $modelClass = "App\\Models\\User";

    public function useGuard(string $guard, string $modelClass): static
    {
        $this->guard = $guard;
        $this->modelClass = $modelClass;
        return $this;
    }




   ////////////////////////////////////////////////////////////////////////
    public function publicRegister(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:' . (new $this->modelClass)->getTable(),
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = $this->modelClass::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user instanceof MustVerifyEmail) {
            $this->sendVerificationNotification($user);
        }

        Auth::guard($this->guard)->login($user);

        return redirect()->route('admin.dashboard')->with('success', __('lang.register_successfully'));
    }

    public function publicLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::guard($this->guard)->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [ __('lang.login_data_not_correct')]
            ]);
        }

        $user = Auth::guard($this->guard)->user();

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            Auth::guard($this->guard)->logout();
            return redirect()->back()->withErrors(['email' =>  __('lang.MSG_EMAIL_NOT_VERIFIED')]);
        }

        return redirect()->intended('admin.dashboard');
    }

    public function publicLogout(Request $request)
    {
        Auth::guard($this->guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', __('lang.msg_logout_successfully'));
    }

    public function publicForgotPassword(Request $request, $broker = null)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker($broker)->sendResetLink($request->only('email'));

        return back()->with('status', __($status));
    }

    public function publicResetPassword(Request $request, $broker = null)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::broker($broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route($this->guard.'.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function publicInvokeEmail(Request $request, $id, $hash)
    {
        $user = $this->getValidUser($id, $hash);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return redirect()->route($this->guard.'.login')->with('status',  __('lang.email_comfirm_successfull'));
    }

    public function publicResentEmail(Request $request)
    {
        $user = Auth::guard($this->guard)->user();

        if (!$user || $user->hasVerifiedEmail()) {
            return back()->with('status',  __('lang.email_already_is_verified_or_not_register_yet'));
        }

        $this->sendVerificationNotification($user);

        return back()->with('status',  __('lang.verification_link_sent'));
    }

    protected function sendVerificationNotification(MustVerifyEmail $user): void
    {
        $verificationUrl = URL::temporarySignedRoute(
            $this->guard .'.verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        $user->notify(new VerifyEmailCustom($verificationUrl));
    }

    protected function getValidUser($id, $hash)
    {
        $user = $this->modelClass::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403,  __('lang.verification_link_not_valid'));
        }

        return $user;
    }
}
