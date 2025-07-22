<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\Api\HomeController  ;
use App\Http\Controllers\Auth\RegisteredUserController;
      

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Pharmacy\Api\PharmacyProductController;

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/pharmacy/{id}',[HomeController::class,'getPharmacy'])->name('pharmacy.product');

Route::get('/filter-products',[HomeController::class,'filterProducts'])->name('filter.proucts');

Route::get('/search',[HomeController::class,'searchProducts'])->name('search');

Route::get('/products/show/{id}',[HomeController::class,'showProduct'])->name('products.show');


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