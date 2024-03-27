<?php

use App\Http\Controllers\BusinessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::Post('/UserReg', [UserController::class, 'register']);
Route::Post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::Post('/changepass', [UserController::class, 'changepass']);
    Route::delete('/logout', [UserController::class, 'logout']);
    Route::resource('/business', BusinessController::class);
});
