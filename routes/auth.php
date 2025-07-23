<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Pharmacy\Web\PharmacistAuthController  ;
//
//
// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {
// Route::middleware('guest:pharmacist')->group(function () {
//
//
//     Route::get('pharmacist/register', [PharmacistAuthController::class, 'showRegisterForm'])
//         ->name('pharmacist.register');
//
//     Route::post('pharmacist/register', [PharmacistAuthController::class, 'register'])->name('pharmacist.register');
//
//     Route::get('pharmacist/login', [PharmacistAuthController::class, 'showLoginForm'])
//         ->name('pharmacist.login');
//
//     Route::post('pharmacist/login', [PharmacistAuthController::class, 'login'])->name('pharmacist.login');
//
//     Route::get('pharmacist/forgot-password', [PharmacistAuthController::class, 'showForgotPasswordForm'])
//         ->name('pharmacist.password.request');
//
//     Route::post('pharmacist/forgot-password', [PharmacistAuthController::class, 'forgotPassword'])
//         ->name('pharmacist.password.email');
//
//     Route::get('pharmacist/reset-password/{token}', [PharmacistAuthController::class, 'showResetPasswordForm'])
//         ->name('pharmacist.password.reset');
//
//     Route::post('pharmacist/reset-password', [PharmacistAuthController::class, 'resetPassword'])
//         ->name('pharmacist.password.store');
//
// });
//
// Route::middleware('auth:pharmacist')->group(function () {
//   Route::get('pharmacist/verify-email/{id}/{hash}',[PharmacistAuthController::class, 'invokeEmail'])->middleware(['signed'])->name('pharmacist.verification.verify');
//   Route::post('/email-resend', [PharmacistAuthController::class, 'resentEmail']);
// 
// });
//
// });
