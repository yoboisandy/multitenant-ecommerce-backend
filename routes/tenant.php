<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
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
    Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::get(
        'configs',
        [\App\Http\Controllers\AuthController::class, 'getConfigs']
    );
    Route::post(
        'orders',
        [\App\Http\Controllers\OrderController::class, 'createOrder']
    );

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        Route::get('me', [\App\Http\Controllers\AuthController::class, 'me']);

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
            Route::delete('products/{id}', [\App\Http\Controllers\ProductController::class, 'deleteProduct']);
            Route::get('categories/{category}/products', [\App\Http\Controllers\ProductController::class, 'getProductByCategory']);

            // orders
            Route::get('orders', [\App\Http\Controllers\OrderController::class, 'getAllOrders']);
            Route::get('orders/{order}', [\App\Http\Controllers\OrderController::class, 'getOrderById']);
            Route::put('orders/{order}', [\App\Http\Controllers\OrderController::class, 'updateOrder']);
        });
    });
});
