<?php

use App\Http\Controllers\carController;
use App\Http\Controllers\helloController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\signupController;
use Illuminate\Support\Facades\Route;


Route::get('/', [helloController::class,"index"])->name('home');
Route::post('/createUser',[signupController::class,'createUser'])->name('createUser');
Route::get('/signup',[signupController::class,'create'])->name('signup');
Route::get('/getUser',[loginController::class,'getUser'])->name('getUser');
Route::get('/login',[loginController::class,'create'])->name('login');
Route::get('/car/search',[carController::class,"search"])->name('car.search');
Route::get('/car/watchlist',[carController::class,"watchlist"])->name('car.watchlist');
Route::put('/car/changefavourability',[carController::class,"changefavourability"])->name('car.changefavourability');
Route::resource('car',carController::class);

