<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController as AdminHomeController ;
use App\Http\Controllers\Dashboard\CategoryController as AdminCategoryController ;
use App\Http\Controllers\Dashboard\{CouponController,PointSettingController } ;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{



  Route::middleware('auth:pharmacist','pharmacist.verified')->prefix('admin')->name('admin.')->group(function(){
    Route::get('dashboard',[AdminHomeController::class,'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::resource('categories',AdminCategoryController::class);
    Route::post('/categories/{id}/restore', [AdminCategoryController::class, 'restore'])->name('categories.restore');
    Route::post('/categories/{id}/force-delete', [AdminCategoryController::class, 'forceDelete'])->name('categories.force-delete');

  });
  ///////pharmacist routes
  Route::prefix('admin')->name('admin.')->group(function () {
      Route::resource('point-settings',PointSettingController::class)->only(['index','store','create','edit','update']);



      Route::resource('coupons',CouponController::class);
      Route::post('/coupons/{id}/restore', [CouponController::class, 'restore'])->name('coupons.restore');
      Route::post('/coupons/{id}/force-delete', [CouponController::class, 'forceDelete'])->name('coupons.force-delete');

  });
  // Route::get('/contact-us',[HomeController::class,'getContact'])->name('contact-us');
  // Route::get('/about',[HomeController::class,'getAbout'])->name('about');
  // Route::get('/category/{id}',[HomeController::class,'categoryShow'])->name('category.show');











    Route::get('pharmacist/profile', [ProfileController::class, 'edit'])->name('pharmacist.profile.edit');
    Route::patch('pharmacist/profile', [ProfileController::class, 'update'])->name('pharmacist.profile.update');
    Route::delete('pharmacist/profile', [ProfileController::class, 'destroy'])->name('pharmacist.profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/pharmacist_auth.php';
require __DIR__.'/owner_auth.php';

 Route::get('/produect/filter', [App\Http\Controllers\produect\filter::class, 'index'])->name('produect.filter');

use App\Http\Controllers\Product\ProductController;
