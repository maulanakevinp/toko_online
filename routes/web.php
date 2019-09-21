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
Route::get('/product', 'HomeController@products')->name('product');
Route::get('/products/search', 'HomeController@search')->name('search');
Route::get('/product/{id}/{name}', 'HomeController@detailsProduct')->name('details-product');

Auth::routes();

Route::get('/dashboard', 'AdminController@index')->name('dashboard');
Route::get('/my-profile', 'AdminController@show')->name('my-profile');
Route::get('/edit-profile', 'AdminController@editProfile')->name('edit-profile');
Route::get('/edit-password', 'AdminController@editPassword')->name('edit-password');

Route::get('/company', 'UtilityController@company')->name('company');
Route::get('/home-picture', 'UtilityController@homePicture')->name('home-picture');

Route::get('/testimonial', 'TestimonialController@index')->name('testimonials');

Route::get('/products', 'ProductController@index')->name('products');

Route::get('/categories', 'CategoryController@index')->name('categories');
