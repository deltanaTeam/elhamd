<?php

namespace App\Http\Controllers\Pharmacist\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pharmacist;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Show the reset password form.
     */
    public function create(Request $request): View
    {
        return view('pharmacist.auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::broker('pharmacists')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Pharmacist $pharmacist) use ($request) {
                $pharmacist->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($pharmacist));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('pharmacist.login')->with('status', __($status))
            : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
    }
}
