<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\{Rules,Rule};
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use App\Helpers\JsonResponse;
use App\Notifications\VerifyEmailCustom;
use App\Notifications\ResetPasswordTokenNotification;
use App\Models\User;
trait SPA_Auth
{
    protected string $guard = 'web';
    protected  $modelClass = User::class;

    public function useGuard(string $guard, $modelClass): static
    {
        $this->guard = $guard;
        $this->modelClass = $modelClass;
        return $this;
    }

    public function publicRegister(Request $request)
    {
        $request->validate([
          'first_name'     => 'required|string|max:255',
          'last_name'     => 'required|string|max:255',
          'governorate'     => 'required|string|max:255',
          'gender'     => 'required|in:male,female',
          'age'     => 'required|integer|min:0|max:130',
          'phone' => ['required','regex:/^\+\d{1,3}\d{4,14}$/', Rule::unique((new $this->modelClass)->getTable())],
          'email'    => 'required|email|unique:' . (new $this->modelClass)->getTable(),
          'password' => ['required', 'confirmed', Rules\Password::defaults()],
       ]);

        $user = $this->modelClass::create([
          'first_name'     => $request->first_name,
          'last_name'     => $request->last_name,
          'governorate'     => $request->governorate,
          'gender'     => $request->gender,
          'age'     => $request->age,
          'phone'     => $request->phone,
          'email'    => $request->email,
          'password' => Hash::make($request->password)
        ]);

        if ($user instanceof MustVerifyEmail) {
            $this->sendVerificationNotification($user);
        }

        $token = $user->createToken($this->guard . '_token')->plainTextToken;

        return JsonResponse::respondSuccess('Account created successfully', [
            'token' => $token,
            'user'  => $user,
        ]);
    }

    public function publicLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $this->modelClass::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.']
            ]);
        }

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            return JsonResponse::respondError('Email not verified.', 403);
        }

        $user->tokens()->delete();

        $token = $user->createToken($this->guard . '_token')->plainTextToken;

        return JsonResponse::respondSuccess('Login successful.', [
            'token' => $token,
            'user'  => $user,
        ]);
    }

    public function publicForgotPassword(Request $request, $broker = null)
    {
        $request->validate(['email' => 'required|email']);

        $user = $this->modelClass::where('email', $request->email)->first();

        if (!$user) {
            return JsonResponse::respondError("No user found with this email", 404);
        }

        $token = Password::broker($broker)->createToken($user);

        $user->notify(new ResetPasswordTokenNotification($token, $user->email));

        return JsonResponse::respondSuccess('Password reset token sent to your email.');
    }


    public function publicResetPassword(Request $request, $broker = null)
    {
        $request->validate([
            'email'    => 'required|email',
            'token'    => 'required|string',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::broker($broker)->reset(
            $request->only('email', 'token', 'password', 'password_confirmation'),
            function ($user, $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return JsonResponse::respondSuccess(__($status));
    }

    public function publicInvokeEmail(Request $request, $id, $hash)
    {
        $user = $this->modelClass::findOrFail($id);

        if (! hash_equals($hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }
        // $user = $this->getValidUser($id, $hash);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return JsonResponse::respondSuccess("Email verified successfully.");
    }

    public function publicResentEmail(Request $request)
    {
        $user = auth($this->guard)->user();

        if (!$user) {
            return JsonResponse::respondError("Unauthenticated", 401);
        }

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            $this->sendVerificationNotification($user);
            return JsonResponse::respondSuccess("Verification email has been sent.");
        }

        return JsonResponse::respondError("Email already verified.", 400);
    }

    protected function sendVerificationNotification(MustVerifyEmail $user): void
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify.' . $this->guard,
            now()->addMinutes(60),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        $user->notify(new VerifyEmailCustom($verificationUrl));
    }

    public function publicLogout(Request $request)
    {
        $user = auth($this->guard)->user();

        if (!$user) {
            return JsonResponse::respondError("Unauthenticated", 401);
        }

        $token = $request->bearerToken();
        if (!$token) {
            return JsonResponse::respondError("No token provided", 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (
            !$accessToken ||
            $accessToken->tokenable_id !== $user->id ||
            $accessToken->tokenable_type !== get_class($user)
        ) {
            return JsonResponse::respondError("Invalid token", 401);
        }

        $accessToken->delete();

        return JsonResponse::respondSuccess('Logged out successfully.');
    }

    protected function getValidUser($id, $hash)
    {
        $user = $this->modelClass::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }

        return $user;
    }
}
