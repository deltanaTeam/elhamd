<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\Api\HomeController  ;

Route::get('/',[HomeController::class,'index'])->name('home');
