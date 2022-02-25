<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\V1\NoteTakerController;
use App\Http\Controllers\V1\ReminderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//    Unauthorized route
    Route::group(['prefix' => 'auth'], function(){
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('/otp', [AuthController::class, 'otp']);
        Route::put('/reset', [AuthController::class, 'reset'])->name('reset');
        Route::put('/user-password', [AuthController::class, 'passwordReset'])->name('password-reset');
    });

    Route::group(['prefix' => 'user','middleware'=>'auth:api'], function(){
        Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('update-profile');
        Route::get('/user-profile', [AuthController::class, 'userProfile']);

        Route::resource('notes',NoteTakerController::class);
        Route::resource('reminder',ReminderController::class);
    });

    Route::group(['prefix' => '','middleware'=>'auth:api'], function(){

    });

