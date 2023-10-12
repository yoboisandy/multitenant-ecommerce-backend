<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreCategoryController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Client\Request;
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

// public routes
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('stores', [StoreController::class, 'store']);
Route::get('/stores/{store}/verify/{token}', [StoreController::class, 'verifyStoreRegistration']);
Route::get('/stores/{store}/check-ready', [StoreController::class, 'checkStoreReady']);
Route::get('/store-categories', [StoreCategoryController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    Route::middleware(['role:admin'])->group(function () {
        Route::get('get-stores', [StoreController::class, 'getStores']);
        Route::put('stores/{store}/update-plan', [StoreController::class, 'updateStorePlan']);
    });
});
