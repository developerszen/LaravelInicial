<?php

Route::get('authors', 'AuthorController@index');
Route::get('authors/{id}', 'AuthorController@show');
Route::post('authors', 'AuthorController@store');