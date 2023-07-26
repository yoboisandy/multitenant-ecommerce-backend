<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::group([
    "prefix" => "/api/{tenant}",
    "middleware" => [
        InitializeTenancyByPath::class,
        'api',
    ]
], function () { 
    // public routes
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('configs', [AuthController::class, 'getConfigs']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);

        Route::middleware('role:owner')->group(function () {
            // store
            Route::get('get-current-store', [\App\Http\Controllers\StoreController::class, 'getCurrentStore']);
            Route::put('/stores', [\App\Http\Controllers\StoreController::class, 'updateStore']);

            // category
            Route::post('categories', [\App\Http\Controllers\CategoryController::class, 'store']);
            Route::put('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update']);
            Route::delete('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy']);
            
            // product
            Route::post('products', [\App\Http\Controllers\ProductController::class, 'save']);
            Route::get('products', [\App\Http\Controllers\ProductController::class, 'getAllProducts']);
            Route::get('products/{id}', [\App\Http\Controllers\ProductController::class, 'getProduct']);
            Route::get('products/{id}', [\App\Http\Controllers\ProductController::class, 'getProduct']);
            Route::delete('products/{id}', [\App\Http\Controllers\ProductController::class, 'deleteProduct']);
            Route::get('categories/{category}/products', [\App\Http\Controllers\ProductController::class, 'getProductByCategory']);
        });
    });
});
