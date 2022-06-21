<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Hash;

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

Route::prefix('auth')->group(function() {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [UserController::class, 'store'])->name('register');

});

Route::group(['middleware' => ['jwt']], function() {

    Route::prefix('auth')->group(function() {

        Route::get('me', [AuthController::class, "me"])->name('me');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');

    });

});

Route::get('generatePass/{password}', function($password) {
    return Hash::make($password);
});
