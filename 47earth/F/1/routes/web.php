<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('books/reset',['as'=>'reset','uses'=>'BooksController@reset']);
Route::post('books',['as'=>'add','uses'=>'BooksController@add']);
Route::get('books/{id?}',['as'=>'inquire','uses'=>'BooksController@inquire']);
Route::put('books/{id?}',['as'=>'fix','uses'=>'BooksController@fix']);
Route::delete('books/{id?}',['as'=>'d','uses'=>'BooksController@d']);
