<?php

use App\Http\Controllers\carController;
use App\Http\Controllers\helloController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\signupController;
use Illuminate\Support\Facades\Route;


Route::get('/', [helloController::class,"index"])->name('home');
Route::get('/signup',[signupController::class,'create'])->name('signup');
Route::get('/login',[loginController::class,'create'])->name('login');
Route::get('/car/search',[carController::class,"search"])->name('car.search');
Route::get('/car/watchlist',[carController::class,"watchlist"])->name('car.watchlist');
Route::resource('car',carController::class);

