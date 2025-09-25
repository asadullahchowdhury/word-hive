<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Protect all /admin routes with your Bearer token middleware
Route::get('/admin/{any}', function () {
    return view('app'); // same Vue app file
})->where('any', '.*');

// Public routes for the frontend
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
