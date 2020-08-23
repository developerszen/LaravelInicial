<?php

Route::post('login', 'AuthController@login');
Route::post('request-password-recovery', 'UserController@requestPasswordRecovery');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', 'AuthController@logout');

    Route::get('authors', 'AuthorController@index');
    Route::get('authors/{id}', 'AuthorController@show');
    Route::post('authors', 'AuthorController@store');
    Route::put('authors/{id}', 'AuthorController@update');
    Route::get('authors/{id}/edit', 'AuthorController@edit');
    Route::delete('authors/{id}', 'AuthorController@destroy');

    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{id}', 'CategoryController@show');
    Route::post('categories', 'CategoryController@store');
    Route::put('categories/{id}', 'CategoryController@update');
    Route::get('categories/{id}/edit', 'CategoryController@edit');
    Route::delete('categories/{id}', 'CategoryController@destroy');

    Route::get('books/{book}/edit', 'BookController@edit');
    Route::get('books/resources', 'BookController@resources');
    Route::apiResource('books', 'BookController');

});



