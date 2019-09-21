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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/category/{category}', 'HomeController@category')->name('category');
Route::get('/type/{type}/{category}', 'HomeController@type')->name('type');
Route::get('/products', 'HomeController@products')->name('products');
Route::get('/products/search', 'HomeController@search')->name('search');
Route::get('/product/{id}/{name}', 'HomeController@detailsProduct')->name('details-product');

Auth::routes();

Route::get('/dashboard', 'AdminController@index')->name('dashboard');
