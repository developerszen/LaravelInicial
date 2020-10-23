<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::post('request-password-recovery', [UserController::class, 'requestPasswordRecovery']);
Route::post('password-recovery', [UserController::class, 'passwordRecovery']);

Route::middleware(['auth:sanctum', 'reset_verify'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    Route::get('authors', [AuthorController::class, 'index']);
    Route::post('authors', [AuthorController::class, 'store']);
    Route::get('authors/{author}', [AuthorController::class, 'show']);
    Route::get('authors/{author}/edit', [AuthorController::class, 'edit']);
    Route::put('authors/{author}', [AuthorController::class, 'update']);
    Route::delete('authors/{author}', [AuthorController::class, 'destroy']);

//    Route::get('categories', [CategoryController::class, 'index']);
//    Route::post('categories', [CategoryController::class, 'store']);
//    Route::get('categories/{category}', [CategoryController::class, 'show']);
//    Route::put('categories/{category}', [CategoryController::class, 'update']);
//    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

    Route::get('categories/{category}/edit', [CategoryController::class, 'edit']);
    Route::apiResource('categories', CategoryController::class);

    Route::get('books/{book}/edit', [BookController::class, 'edit']);
    Route::apiResource('books', BookController::class);

});