<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\Web\OwnerAuthController  ;

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
Route::middleware('guest:web-owner')->group(function () {


    Route::get('web-owner/register', [OwnerAuthController::class, 'showRegisterForm'])
        ->name('web-owner.register');

    // Route::post('register', [web-ownerAuthController::class, 'register']);

    Route::get('web-owner/login', [OwnerAuthController::class, 'showLoginForm'])
        ->name('web-owner.login');

    Route::post('web-owner/login', [OwnerAuthController::class, 'login']);

    Route::get('web-owner/forgot-password', [OwnerAuthController::class, 'showForgotPasswordForm'])
        ->name('web-owner.password.request');

    Route::post('web-owner/forgot-password', [OwnerAuthController::class, 'forgotPassword'])
        ->name('web-owner.password.email');

    Route::get('web-owner/reset-password/{token}', [OwnerAuthController::class, 'showResetPasswordForm'])
        ->name('web-owner.password.reset');

    Route::post('web-owner/reset-password', [OwnerAuthController::class, 'resetPassword'])
        ->name('web-owner.password.store');

});

Route::middleware('auth:web-owner')->group(function () {
  Route::get('/web-owner/email/verify', function () {
    return view('web-owner.auth.verify-email');
})->middleware('auth:web-owner')->name('web-owner.verification.notice');
  Route::get('web-owner/verify-email/{id}/{hash}',[OwnerAuthController::class, 'invokeEmail'])->middleware(['signed'])->name('web-owner.verification.verify');
  Route::post('web-owner/email-resend', [OwnerAuthController::class, 'resentEmail'])->name('web-owner.verification.send');
  Route::post('web-owner/logout', [OwnerAuthController::class, 'logout'])->name('web-owner.logout');

});

});
