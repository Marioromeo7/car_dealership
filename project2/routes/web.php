<?php

use App\Http\Controllers\helloController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\signupController;
use Illuminate\Support\Facades\Route;


Route::get('/', [helloController::class,"index"])->name('home');
Route::get('/signup',[signupController::class,'create'])->name('signup');
Route::get('/login',[loginController::class,'create'])->name('login');
