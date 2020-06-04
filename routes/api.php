<?php

Route::get('authors', 'AuthorsController@index');
Route::post('authors', 'AuthorsController@store');
Route::get('authors/{id}', 'AuthorsController@show');
Route::put('authors/{id}', 'AuthorsController@update');
Route::delete('authors/{id}', 'AuthorsController@destroy');

Route::get('categories', 'CategoriesController@index');
Route::post('categories', 'CategoriesController@store');
Route::get('categories/{id}', 'CategoriesController@show');
Route::put('categories/{id}', 'CategoriesController@update');
Route::delete('categories/{id}', 'CategoriesController@destroy');

Route::get('books', 'BooksController@index');
Route::post('books', 'BooksController@store');
Route::get('books/{id}', 'BooksController@show');
Route::put('books/{id}', 'BooksController@update');
Route::delete('books/{id}', 'BooksController@destroy');
