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
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);

        Route::middleware('role:owner')->group(function () {
            Route::post('categories', [\App\Http\Controllers\CategoryController::class, 'store']);
        });
    });
});
