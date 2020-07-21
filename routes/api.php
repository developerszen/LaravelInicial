<?php

Route::post('login', 'AuthController@login');

Route::middleware(['auth:api'])->group(function () {
    Route::post('authors', 'AuthorController@store');
    Route::get('authors', 'AuthorController@index');
    Route::get('authors/{author}', 'AuthorController@show');
    Route::put('authors/{author}', 'AuthorController@update');
    Route::delete('authors/{author}', 'AuthorController@destroy');
});

