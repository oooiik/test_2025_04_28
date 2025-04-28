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

Route::get('products', 'App\Http\Controllers\ProductController@index')->name('products.index');
Route::post('products', 'App\Http\Controllers\ProductController@store')->name('products.store');
Route::get('products/{id}', 'App\Http\Controllers\ProductController@show')->name('products.show');
Route::put('products/{id}', 'App\Http\Controllers\ProductController@update')->name('products.update');
Route::delete('products/{id}', 'App\Http\Controllers\ProductController@destroy')->name('products.destroy');
