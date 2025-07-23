<?php

// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\EmailVerificationNotificationController;
// use App\Http\Controllers\Auth\EmailVerificationPromptController;
// use App\Http\Controllers\Auth\NewPasswordController;
// use App\Http\Controllers\Auth\PasswordController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pharmacy\Web\PharmacistAuthController  ;

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
Route::middleware('guest')->group(function () {


    Route::get('pharmacist/register', [PharmacistAuthController::class, 'showRegisterForm'])
        ->name('pharmacist.register');

    // Route::post('register', [PharmacistAuthController::class, 'register']);

    Route::get('pharmacist/login', [PharmacistAuthController::class, 'showLoginForm'])
        ->name('pharmacist.login');

    Route::post('pharmacist/login', [PharmacistAuthController::class, 'login']);

    Route::get('pharmacist/forgot-password', [PharmacistAuthController::class, 'showForgotPasswordForm'])
        ->name('pharmacist.password.request');

    Route::post('pharmacist/forgot-password', [PharmacistAuthController::class, 'forgotPassword'])
        ->name('pharmacist.password.email');

    Route::get('pharmacist/reset-password/{token}', [PharmacistAuthController::class, 'showResetPasswordForm'])
        ->name('pharmacist.password.reset');

    Route::post('pharmacist/reset-password', [PharmacistAuthController::class, 'resetPassword'])
        ->name('pharmacist.password.store');

});

Route::middleware('auth:pharmacist')->group(function () {
  Route::get('/pharmacist/email/verify', function () {
    return view('pharmacist.auth.verify-email');
})->middleware('auth:pharmacist')->name('verification.notice');
  Route::get('pharmacist/verify-email/{id}/{hash}',[PharmacistAuthController::class, 'invokeEmail'])->middleware(['signed'])->name('pharmacist.verification.verify');
  Route::post('pharmacist/email-resend', [PharmacistAuthController::class, 'resentEmail'])->name('pharmacist.verification.send');
  Route::post('pharmacist/logout', [PharmacistAuthController::class, 'logout'])->name('pharmacist.logout');

});

});
