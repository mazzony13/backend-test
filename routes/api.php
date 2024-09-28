<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth;
use App\Http\Controllers\Api\v1\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    //login and register routes
    Route::group(['prefix' => 'auth'], function(){
        Route::post('login', Auth\LoginController::class);
        Route::post('register', Auth\RegisterController::class);
    });

    // product routes
    Route::group(['prefix' => 'products'], function(){
        Route::post('/', Product\CreateController::class);
        Route::put('/{uuid}', Product\UpdateController::class);
    });


});
