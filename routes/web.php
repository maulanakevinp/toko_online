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

//Home Controller
Route::get('/', 'HomeController@index')->name('home');
Route::get('/category/{category}', 'HomeController@category')->name('category');
Route::get('/type/{type}/{category}', 'HomeController@type')->name('type');
Route::get('/product', 'HomeController@products')->name('product');
Route::get('/search/product', 'HomeController@search')->name('search');
Route::get('/product/{id}/{name}', 'HomeController@detailsProduct')->name('details-product');

//Auth
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'password.email' => false, // Email Verification Routes...
    'password.request' => false, // Email Verification Routes...
    'password.update' => false, // Email Verification Routes...
    'password.reset' => false, // Email Verification Routes...
]);

//Admin Controller
Route::get('/dashboard', 'AdminController@index')->name('dashboard');
Route::get('/my-profile', 'AdminController@show')->name('my-profile');
Route::get('/edit-profile', 'AdminController@editProfile')->name('edit-profile');
Route::patch('/edit-profile/{id}', 'AdminController@updateProfile')->name('update-profile');
Route::get('/edit-password', 'AdminController@editPassword')->name('edit-password');
Route::patch('/edit-password/{id}', 'AdminController@updatePassword')->name('update-password');

//Utility Controller
Route::get('/company', 'UtilityController@company')->name('company');
Route::patch('/update-company/{id}', 'UtilityController@updateCompany')->name('update-company');
Route::get('/home-picture', 'UtilityController@homePicture')->name('home-picture');
Route::patch('/update-home-picture/{id}/{photo}', 'UtilityController@updateHomePicture')->name('update-home-picture');
Route::delete('/destroy-home-picture/{id}/{photo}', 'UtilityController@destroyHomePicture')->name('destroy-home-picture');

//Testimonial Controller
Route::resource('/testimonials', 'TestimonialController')->except(['show', 'create']);

//Product Controller
Route::resource('/products', 'ProductController')->except(['show']);
Route::get('/search/products', 'ProductController@search')->name('search-products');
Route::get('/p/{category}', 'ProductController@category');
Route::get('/p/{type}/{category}', 'ProductController@type');
Route::post('/get-types', 'ProductController@getTypes')->name('get-types');
Route::get('/get-types', 'ProductController@getTypes')->name('get-types');
Route::patch('/update-product-picture/{id}/{photo}', 'ProductController@updatePicture')->name('update-product-picture');
Route::delete('/destroy-product-picture/{id}/{photo}', 'ProductController@destroyPicture')->name('destroy-product-picture');

//Category Controller
Route::resource('/categories', 'CategoryController')->except(['show']);

//Type Controller
Route::post('/types/{category}', 'TypeController@store')->name('types.store');
Route::patch('/types/{id}/{category}', 'TypeController@update')->name('types.update');
Route::delete('/types/{id}/{category}', 'TypeController@destroy')->name('types.destroy');
Route::post('/get-type', 'CategoryController@getType')->name('get-type');
Route::get('/get-type', 'CategoryController@getType')->name('get-type');
