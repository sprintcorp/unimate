<?php

use App\Http\Controllers\v1\AuthController;
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

Route::group([
    'prefix' => 'auth'

], function () {
//    Unauthorized route
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('/otp', [AuthController::class, 'otp']);
    Route::put('/reset', [AuthController::class, 'reset']);
    Route::put('/user-password', [AuthController::class, 'passwordReset']);

    Route::group(['prefix' => 'public','middleware'=>'authorization'], function(){

    Route::put('/update-profile', [AuthController::class, 'updateProfile']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    });
});

