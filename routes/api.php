<?php

use App\Http\Controllers\AuthController;
use App\Models\LibraryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::controller(AuthController::class)->prefix('auth')->group(function() {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
    });

    Route::controller(LibraryItem::class)->prefix('item')->group(function() {
            Route::get('/items', 'index');
    });

    Route::middleware('auth:sanctum')->group(function() {
        Route::controller(AuthController::class)->prefix('auth')->group(function() {
            Route::post('/logout', 'logout');
        });

        Route::controller(LibraryItem::class)->prefix('item')->group(function() {
            Route::get('/item/{id}', 'show');
            Route::post('/item', 'store');
            Route::put('/item/{id}', 'update');
            Route::delete('/item/{id}', 'destroy');
        });
    });
});