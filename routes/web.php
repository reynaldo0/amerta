<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibraryItemController;
use App\Http\Controllers\RouteController;
use App\Models\LibraryItem;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function() {
    Route::middleware('guest')->group(function(){
        Route::get('/register', 'showRegisterForm');
        Route::get('/login', 'showLoginForm');
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });
});

Route::middleware('auth')->group(function() {
    Route::controller(RouteController::class)->group(function() {
        Route::get('/contents', 'content');
        Route::get('/items', 'item');
    });

    Route::controller(ContentController::class)->group(function() {
        Route::post('/create/content', 'store');
        Route::delete('/content/{content}', 'destroy');
    });

    Route::controller(LibraryItemController::class)->group(function() {
        Route::post('/create/item', 'store');
        Route::delete('/item/{item}', 'destroy');
    });
});
