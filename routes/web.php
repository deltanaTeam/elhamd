<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController as AdminHomeController ;
use App\Http\Controllers\Dashboard\CategoryController as AdminCategoryController ;
use App\Http\Controllers\Dashboard\{CouponController,PointSettingController } ;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Pharmacy\Api\PharmacyProductController;


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{



  Route::middleware('auth:pharmacist','verified')->prefix('admin')->name('admin.')->group(function(){
    // عرض جميع المنتجات
    Route::get('products', [PharmacyProductController::class, 'index'])->name('products.index');
    
    // عرض صفحة إضافة منتج
    Route::get('products/create', [PharmacyProductController::class, 'create'])->name('products.create');
    
    // إضافة منتج جديد
    Route::post('products', [PharmacyProductController::class, 'store'])->name('products.store');
    
    // تعديل منتج
    Route::get('products/{product}/edit', [PharmacyProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [PharmacyProductController::class, 'update'])->name('products.update');
    
    // حذف منتج
    Route::delete('products/{product}', [PharmacyProductController::class, 'destroy'])->name('products.destroy');
});




  Route::middleware('auth:pharmacist','verified')->prefix('admin')->name('admin.')->group(function(){
    Route::get('dashboard',[AdminHomeController::class,'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::resource('categories',AdminCategoryController::class);
    Route::post('/categories/{id}/restore', [AdminCategoryController::class, 'restore'])->name('categories.restore');
    Route::post('/categories/{id}/force-delete', [AdminCategoryController::class, 'forceDelete'])->name('categories.force-delete');

  });
  ///////pharmacist routes
  Route::prefix('admin')->name('admin.')->group(function () {
      Route::get('/point-settings/edit', [PointSettingController::class, 'form'])->name('point-settings.form');
      Route::post('/point-settings', [PointSettingController::class, 'save'])->name('point-settings.save');
      Route::get('/point-settings', [PointSettingController::class, 'index'])->name('point-settings.index');

      Route::resource('coupons',CouponController::class);
      Route::post('/coupons/{id}/restore', [CouponController::class, 'restore'])->name('coupons.restore');
      Route::post('/coupons/{id}/force-delete', [CouponController::class, 'forceDelete'])->name('coupons.force-delete');

  });
  // Route::get('/contact-us',[HomeController::class,'getContact'])->name('contact-us');
  // Route::get('/about',[HomeController::class,'getAbout'])->name('about');
  // Route::get('/category/{id}',[HomeController::class,'categoryShow'])->name('category.show');











    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/pharmacist_auth.php';
require __DIR__.'/owner_auth.php';

 Route::get('/produect/filter', [App\Http\Controllers\produect\filter::class, 'index'])->name('produect.filter');

use App\Http\Controllers\Product\ProductController;


