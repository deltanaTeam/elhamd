<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\API\ProductRatingController;
      
use App\Http\Controllers\Client\Api\MedicationController;

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Pharmacy\Api\PharmacyProductController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\Client\Api\{HomeController,CartController ,OrderController,ClientAuthController}  ;

RateLimiter::for('medications_limiter', function ($request) {
       return Limit::perMinute(1)->by(optional($request->user())->id ?: $request->ip());
   });
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/pharmacy/{id}',[HomeController::class,'getPharmacy'])->name('pharmacy.product');
Route::get('/filter-products',[HomeController::class,'filterProducts'])->name('filter.proucts');
Route::get('/search',[HomeController::class,'searchProducts'])->name('search');
Route::get('/products/show/{id}',[HomeController::class,'showProduct'])->name('products.show');
Route::get('/categories/show/{id}',[HomeController::class,'showCategory'])->name('categories.show');
Route::get('/brands/show/{id}',[HomeController::class,'showBrand'])->name('brands.show');



Route::middleware('auth:sanctum')->prefix('product')->group(function () {
    // عرض جميع المنتجات
    Route::get('products', [PharmacyProductController::class, 'index']);

    // إضافة منتج جديد
    Route::post('add', [PharmacyProductController::class, 'store']);  // تأكد من أن الـ URL هو '/add'

    // تحديث منتج موجود
    Route::put('/{product}', [PharmacyProductController::class, 'update']);

    // حذف منتج
    Route::delete('/{product}', [PharmacyProductController::class, 'destroy']);
});


Route::middleware('guest')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store']); // تسجيل المستخدم عبر API
});

// Route::prefix('products')->name('products.')->group(function () {
//     Route::get('/', [ProductController::class, 'index'])->name('index');
//     Route::post('/', [ProductController::class, 'store'])->name('store');
//     Route::get('/{product}', [ProductController::class, 'show'])->name('show');
//     Route::put('/{product}', [ProductController::class, 'update'])->name('update');
//     Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
// });



Route::middleware('auth:sanctum')->group(function () {
    Route::post('products/{product}/ratings', [ProductRatingController::class, 'store']);
    Route::get('products/{product}/ratings', [ProductRatingController::class, 'index']);
});
Route::middleware(['guest:client'])->group(function () {

      Route::post('/register', [ClientAuthController::class, 'register']);
      Route::post('/login', [ClientAuthController::class, 'login']);
      Route::post('forgot-password', [ClientAuthController::class, 'forgotPassword'])
          ->name('password.email');
      Route::post('reset-password', [ClientAuthController::class, 'resetPassword'])
          ->name('password.store');
      Route::get('/verify-email/{id}/{hash}',[ClientAuthController::class, 'invokeEmail'])->middleware(['signed'])->name('verification.verify.client');

});
Route::get('/email-resend', [ClientAuthController::class, 'resentEmail'])->middleware('auth:client');

Route::middleware(['auth:client', 'verified.api'])->group(function () {

  Route::post('logout', [ClientAuthController::class, 'logout'])
      ->name('logout');
  Route::get('/cart',[CartController::class,'index'])->name('cart.index');
  Route::post('/add-to-cart',[CartController::class,'store'])->name('cart.store');
  Route::post('/save-orders',[OrderController::class,'store'])->name('orders.store');
  Route::get('/user-orders',[OrderController::class,'index'])->name('orders.index');
  Route::get('/user-order/show/{id}',[OrderController::class,'show'])->name('orders.show');

});


   Route::middleware(['auth:client',])->group(function () {
    Route::post('/medications', [MedicationController::class, 'store']);
    Route::get('/medications/today', [MedicationController::class, 'today']);
    Route::post('/medications/{id}/expire-decision', [MedicationController::class, 'handleExpiration']);
    Route::delete('/medications/{id}', [MedicationController::class, 'destroy']);
    Route::get('/medications/search', [MedicationController::class, 'search']);
});
