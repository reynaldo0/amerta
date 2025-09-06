<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LibraryItemController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\QuizController;
use App\Models\LibraryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::controller(LibraryItemController::class)->group(function () {
        Route::get('/items', 'index');
        Route::get('/item/{id}', 'show');
    });

    Route::controller(ContentController::class)->group(function () {
        Route::get('/contents', 'index');
        Route::get('/content/{content}', 'show');
        Route::get('/contents/articles', 'articles');
        Route::get('/contents/events', 'events');
    });

    Route::controller(QuizController::class)->group(function () {
        Route::get('/quiz', 'index');
        Route::get('/quizzes', [QuizController::class, 'all']);
        Route::get('/quiz/{id}', action: 'show');
    });

    Route::controller(MailController::class)->group(function () {
        Route::post('/mail', 'store');
    });
});
