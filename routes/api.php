<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CityController;
use App\Http\Controllers\Api\v1\EstateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('confirm', [AuthController::class, 'confirm']);
Route::post('set-password', [AuthController::class, 'setPassword']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('logout', [AuthController::class, 'logout']);

Route::apiResource("estate", EstateController::class)->parameter("estate", "estate:slug");
Route::apiResource("city", CityController::class);
