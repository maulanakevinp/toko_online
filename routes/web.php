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
Route::get('/search/product', 'HomeController@search')->name('search');
Route::get('/product/{id}/{name}', 'HomeController@detailsProduct')->name('details-product');

Auth::routes();

Route::get('/dashboard', 'AdminController@index')->name('dashboard');
Route::get('/my-profile', 'AdminController@show')->name('my-profile');
Route::get('/edit-profile', 'AdminController@editProfile')->name('edit-profile');
Route::patch('/edit-profile/{id}', 'AdminController@updateProfile')->name('update-profile');
Route::get('/edit-password', 'AdminController@editPassword')->name('edit-password');
Route::patch('/edit-password/{id}', 'AdminController@updatePassword')->name('update-password');

Route::get('/company', 'UtilityController@company')->name('company');
Route::patch('/update-company/{id}', 'UtilityController@updateCompany')->name('update-company');

Route::get('/home-picture', 'UtilityController@homePicture')->name('home-picture');
Route::patch('/update-home-picture/{id}/{photo}', 'UtilityController@updateHomePicture')->name('update-home-picture');
Route::delete('/destroy-home-picture/{id}/{photo}', 'UtilityController@destroyHomePicture')->name('destroy-home-picture');

Route::resource('/testimonials', 'TestimonialController')->except([
    'show'
]);

Route::resource('/products', 'ProductController')->except([
    'show'
]);
Route::get('/search/products', 'ProductController@search')->name('search-products');
Route::get('/p/{category}', 'ProductController@category');
Route::get('/p/{type}/{category}', 'ProductController@type');
Route::post('/get-types', 'ProductController@getTypes')->name('get-types');
Route::get('/get-types', 'ProductController@getTypes')->name('get-types');
Route::get('/update-image-product/{id}/{photo}', 'ProductController@updateImage')->name('update-image-product');
Route::delete('/delete-image-product/{id}/{photo}', 'ProductController@deleteImage')->name('delete-image-product');

Route::resource('/categories', 'CategoryController')->except([
    'show'
]);

Route::resource('/types', 'CategoryController')->except([
    'show', 'index', 'create', 'store'
]);
Route::post('/get-type', 'CategoryController@getType')->name('get-type');
Route::get('/get-type', 'CategoryController@getType')->name('get-type');

Route::post('/types/{category}', 'TypeController@store')->name('types.store');
