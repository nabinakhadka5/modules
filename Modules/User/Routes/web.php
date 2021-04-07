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

Route::get('/', 'HomeController@index')->name('user.homepage');

Route::get('about', 'AboutController@index')->name('user.about');

Route::prefix('blog')->group(function (){
    Route::get('/', 'BlogController@index')->name('user.blog_index');
    Route::get('/show/{id}', 'BlogController@show')->name('user.blog_show');
});

Route::get('contact', 'ContactController@index')->name('user.contact');

Route::prefix('product')->group(function (){
    Route::get('/', 'ProductController@index')->name('user.product_index');
    Route::get('/show/{id}', 'ProductController@show')->name('user.product_show');
});

Route::get('cart', 'CartController@index')->name('user.cart');