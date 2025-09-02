<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibraryItemController;
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
});
