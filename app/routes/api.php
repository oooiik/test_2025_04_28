<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('categories', 'App\Http\Controllers\CategoryController@index')->name('categories.index');
Route::post('categories', 'App\Http\Controllers\CategoryController@store')->name('categories.store');
Route::get('categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('categories.show');
Route::put('categories/{id}', 'App\Http\Controllers\CategoryController@update')->name('categories.update');
Route::delete('categories/{id}', 'App\Http\Controllers\CategoryController@destroy')->name('categories.destroy');

Route::get('articles', 'App\Http\Controllers\ArticleController@index')->name('articles.index');
Route::post('articles', 'App\Http\Controllers\ArticleController@store')->name('articles.store');
Route::get('articles/{id}', 'App\Http\Controllers\ArticleController@show')->name('articles.show');
Route::put('articles/{id}', 'App\Http\Controllers\ArticleController@update')->name('articles.update');
Route::delete('articles/{id}', 'App\Http\Controllers\ArticleController@destroy')->name('articles.destroy');
