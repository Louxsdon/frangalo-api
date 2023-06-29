<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\OrderController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('auth/login', [AuthController::class, "login"]);
Route::post('auth/verify', [AuthController::class, "verify"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);
});

Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, "logout"]);
});
