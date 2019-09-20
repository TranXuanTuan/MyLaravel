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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'UserController@profile')->name('profile');
    // order info
    Route::get('/order/{book_id}', 'OrderController@index')->name('order');
    // cart info
    Route::group(['prefix' => 'cart', 'as' => 'cart-'], function () {
        Route::get('/', 'OrderController@cart')->name('index');
        Route::get('cancel/{id}', 'OrderController@cancel')->name('cancel');
        Route::get('complete', 'OrderController@complete')->name('complete');
    });
});

Route::group(['prefix' => 'category', 'as' => 'category-'], function () {
    Route::get('/', 'CategoryController@index')->name('index');
    Route::get('add', 'CategoryController@create')->name('add');
    Route::post('add', 'CategoryController@store')->name('add');
    Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
    Route::post('edit/{id}', 'CategoryController@update')->name('edit');
    Route::get('detail/{id}', 'CategoryController@show')->name('detail');
    Route::post('delete', 'CategoryController@destroy')->name('delete');
});

Route::group(['prefix' => 'book', 'as' => 'book-'], function () {
    Route::get('/', 'BookController@index')->name('index');
    Route::get('detail/{id}', 'BookController@show')->name('detail');
});

Route::get('receipt', 'ReceiptController@index');

Auth::routes();

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin-'], function () {
    // show form login if not login yet
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@handleLogin')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    Route::group(['middleware' => 'check_admin_login'], function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::group(['prefix' => 'category', 'as' => 'category-'], function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/add', 'CategoryController@create')->name('add');
            Route::post('/add', 'CategoryController@store')->name('add');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('edit');
            Route::post('/edit/{id}', 'CategoryController@update')->name('edit');
            Route::get('/detail/{id}', 'CategoryController@show')->name('detail');
            Route::post('/delete/{id}', 'CategoryController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'user', 'as' => 'user-'], function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/add', 'UserController@create')->name('add');
            Route::post('/add', 'UserController@store')->name('add');
            Route::get('/edit/{id}', 'UserController@edit')->name('edit');
            Route::post('/edit/{id}', 'UserController@update')->name('edit');
            Route::get('/detail/{id}', 'UserController@show')->name('detail');
            Route::post('/delete/{id}', 'UserController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'book', 'as' => 'book-'], function () {
            Route::get('/', 'BookController@index')->name('index');
            Route::get('/add', 'BookController@create')->name('add');
            Route::post('/add', 'BookController@store')->name('add');
            Route::get('/edit/{id}', 'BookController@edit')->name('edit');
            Route::post('/edit/{id}', 'BookController@update')->name('edit');
            Route::get('/detail/{id}', 'BookController@show')->name('detail');
            Route::post('/delete/{id}', 'BookController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'receipt', 'as' => 'receipt-'], function () {
            Route::get('/', 'ReceiptController@index')->name('index');
            Route::get('/add', 'ReceiptController@create')->name('add');
        });
    });
});