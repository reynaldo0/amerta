<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibraryItemController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\QuizController;
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
    Route::controller(AuthController::class)->group(function() {
        Route::get('/logout', 'simpleLogout');
    });

    Route::controller(RouteController::class)->group(function() {
        Route::get('/admin/dashboard', 'dashboard');
        Route::get('/admin/contents', 'content');
        Route::get('/admin/items', 'item');
        Route::get('/admin/quizzes', 'quiz');
        Route::get('/admin/mails', 'mail');
        Route::get('/admin/stories', 'stories');
    });

    Route::controller(ContentController::class)->group(function() {
        Route::post('/create/content', 'store');
        Route::post('/content/{content}/edit', 'update');
        Route::delete('/content/{content}', 'destroy');
    });

    Route::controller(LibraryItemController::class)->group(function() {
        Route::post('/create/item', 'store');
        Route::delete('/item/{id}', 'destroy');
        Route::put('/item/{id}', 'update');
    });

    Route::controller(QuizController::class)->group(function() {
        Route::post('/create/quiz', 'store');
        Route::post('/create/quiz/new', 'new');
        Route::delete('/quiz/{id}', 'destroy');
    });
});
