<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.list');
Route::post('/product-store', 'App\Http\Controllers\ProductController@store')->name('product.store');
Route::get('/product/{id}/edit', 'App\Http\Controllers\ProductController@edit')->name('product.edit');
Route::post('/product/{id}/update', 'App\Http\Controllers\ProductController@update')->name('product.update');
Route::get('/product/{id}/delete', 'App\Http\Controllers\ProductController@destroy')->name('product.destroy');
