<?php

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::view('/about-us', 'aboutus');

Route::get('/register', 'CustomersController@register');
Route::post('/register', 'CustomersController@store')->name('register');
Route::get('/logout', 'CustomersController@logout');
Route::post('/login', 'CustomersController@login')->name('login');

Route::get('/checkout', 'OrdersController@checkout');

Route::get('/contact', 'ContactController@show');
Route::post('/contact', 'ContactController@mailToAdmin')->name('mail');

Route::post('/order', 'OrdersController@store')->name('order');

Route::post('/coupon', 'OrdersController@store')->name('order');

Route::get('/', 'ProductsController@index');
Route::get('{category}', 'ProductsController@category');
Route::get('{category}/{product}', 'ProductsController@product');
