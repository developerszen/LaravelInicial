<?php

Route::post('login', 'AuthController@login');

Route::middleware(['auth:api'])->group(function () {

    Route::post('authors', 'AuthorController@store');
    Route::get('authors', 'AuthorController@index');
    Route::get('authors/{author}', 'AuthorController@show');
    Route::put('authors/{author}', 'AuthorController@update');
    Route::delete('authors/{author}', 'AuthorController@destroy');

    Route::post('categories', 'CategoryController@store');
    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{category}', 'CategoryController@show');
    Route::put('categories/{category}', 'CategoryController@update');
    Route::delete('categories/{category}', 'CategoryController@destroy');

    Route::post('books', 'BookController@store');
    Route::get('books', 'BookController@index');
    Route::get('books/{book}', 'BookController@show');
    Route::put('books/{book}', 'BookController@update');
    Route::delete('books/{book}', 'BookController@destroy');

});


