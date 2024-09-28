<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth;
use App\Http\Controllers\Api\v1\Product;
use App\Http\Controllers\Api\v1\User;
use App\Http\Controllers\Api\v1\UserType;
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

    //routes need auth user to access
    Route::middleware(['auth:sanctum'])->group(function () {
    //products routes
    Route::group(['prefix' => 'products'], function(){
        //api rate limited to 10 times per minute
        Route::middleware(['role:super-admin','throttle:10,1'])->group(function(){
            //routes accessed by admin only
            Route::post('/', Product\CreateController::class)->middleware(); // create product
            Route::put('/{uuid}', Product\UpdateController::class); // update product
            Route::delete('/{uuid}', Product\DeleteController::class); //delete product
        });
        Route::get('/{uuid}', Product\ShowController::class); //show product
        Route::get('/', Product\IndexController::class); //list products
    });

    //user routes
    Route::group(['prefix' => 'users'], function(){
        //api rate limited to 10 times per minute
        Route::middleware(['role:super-admin'])->group(function(){
            //routes accessed by admin only
            Route::post('/', User\CreateController::class); // create user only admin can create new user any other user can register
            Route::get('/', User\IndexController::class); //list users (only admin can list all users)
        });
        Route::get('/{uuid}', User\ShowController::class); //show user
        Route::put('/{uuid}', User\UpdateController::class)->middleware('throttle:10,1'); // update user
        Route::delete('/{uuid}', User\DeleteController::class); //delete user
    });

    //user types route
    Route::group(['prefix' => 'user-types'], function(){
        //api rate limited to 10 times per minute
        Route::middleware(['role:super-admin'])->group(function(){
            //routes accessed by admin only
            Route::post('/', UserType\CreateController::class); // create user type
            Route::get('/{uuid}', UserType\ShowController::class); //show user type
            Route::put('/{uuid}', UserType\UpdateController::class)->middleware('throttle:10,1'); // update user type
            Route::delete('/{uuid}', UserType\DeleteController::class); //delete user type
        });

        //this one is public to allow users list available types on registration
        Route::get('/', UserType\IndexController::class); //list user types (only admin can list all users)

    });



});


});
