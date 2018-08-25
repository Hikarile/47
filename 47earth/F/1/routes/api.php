<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('books/reset',['as'=>'reset','uses'=>'BooksController@reset']);
Route::post('books',['as'=>'add','uses'=>'BooksController@add']);
Route::get('books/{id?}',['as'=>'inquire','uses'=>'BooksController@inquire']);
Route::put('books/{id?}',['as'=>'fix','uses'=>'BooksController@fix']);
Route::delete('books/{id?}',['as'=>'d','uses'=>'BooksController@d']);
