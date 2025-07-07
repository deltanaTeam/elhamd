<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as AdminHomeController ;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController ;

use App\Http\Controllers\HomeController  ;

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
  Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('dashboard',[AdminHomeController::class,'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::resource('categories',AdminCategoryController::class);

  });
  Route::get('/',[HomeController::class,'index'])->name('home');
  Route::get('/contact-us',[HomeController::class,'getContact'])->name('contact-us');
  Route::get('/about',[HomeController::class,'getAbout'])->name('about');
  Route::get('/category/{id}',[HomeController::class,'categoryShow'])->name('category.show');


});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


 Route::get('/produect/filter', [App\Http\Controllers\produect\filter::class, 'index'])->name('produect.filter');