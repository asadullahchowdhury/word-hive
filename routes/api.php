<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Front\BlogController;
use App\Http\Controllers\Api\Admin\AdminBlogController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Middleware\CheckAdmin;
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

// Admin panel routes (protected)
Route::prefix('admin')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('checkAdmin')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::apiResource('blogs', AdminBlogController::class);
    });
});

// Front panel routes (public)
Route::prefix('front')->group(function () {
    Route::apiResource('blogs', BlogController::class)->only(['index', 'show']);
});
