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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('home', 'HomeController');

Route::resource('products', 'ProductController');

Route::resource('categories', 'CategoryController');

Route::resource('units', 'UnitController');

Route::resource('stocks', 'StockController');

Route::resource('imports', 'ImportController');

Route::resource('orders', 'OrderController');

Route::resource('users', 'UserController');

Route::resource('units', 'UnitsController');


Route::resource('users', 'UserController');