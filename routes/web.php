<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController as AdminHomeController ;
use App\Http\Controllers\Dashboard\CategoryController as AdminCategoryController ;
use App\Http\Controllers\Dashboard\{CouponController,PointSettingController } ;


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{



  Route::prefix('admin')->name('admin.')->group(function(){
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


});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/',[HomeController::class,'index'])->name('home');

Route::middleware('auth:web')->group(function () {
  Route::get('/jjkk',function(){
    return "jgkrg666666666";
  })->name('hojjjjkjkme');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


 Route::get('/produect/filter', [App\Http\Controllers\produect\filter::class, 'index'])->name('produect.filter');

use App\Http\Controllers\Product\ProductController;


