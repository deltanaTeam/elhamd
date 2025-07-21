<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\Api\HomeController  ;

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/pharmacy/{id}',[HomeController::class,'getPharmacy'])->name('pharmacy.product');

Route::get('/filter-products',[HomeController::class,'filterProducts'])->name('filter.proucts');

Route::get('/search',[HomeController::class,'searchProducts'])->name('search');

Route::get('/products/show/{id}',[HomeController::class,'showProduct'])->name('products.show');
