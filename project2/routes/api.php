<?php

use App\Http\Controllers\API\carController;
use App\Http\Controllers\API\loginController;
use App\Http\Controllers\API\signupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\helloController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/hello', [helloController::class, 'index'])
    ->name('api.hello.index');
Route::post('/createUser',[signupController::class,'createUser'])->name('api.createUser');
Route::post('/getUser',[loginController::class,'getUser'])->name('api.getUser');
Route::get('/car/search',[carController::class,"search"])->name('api.car.search');
Route::get('/car/watchlist',[carController::class,"watchlist"])->name('api.car.watchlist');
Route::put('/car/changefavourability',[carController::class,"changefavourability"])->name('api.car.changefavourability');
Route::resource('api.car',carController::class);