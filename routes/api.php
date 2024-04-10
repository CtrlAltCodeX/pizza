<?php

use App\Http\Controllers\Admin\API\LoginController;
use App\Http\Controllers\Admin\API\OrdersController;
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

// Route::middleware('auth:sanctum')->group(function () {
    Route::get('orders', [OrdersController::class, 'index']);
    
    Route::get('/logout', [LoginController::class, 'logout']);
// });

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [LoginController::class, 'register']);
