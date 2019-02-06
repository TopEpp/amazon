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
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::middleware('can:isAdmin')->group(function () {

        Route::get('/', 'DashBoardController@index')->name('dashboard');
        Route::get('/dashboard', 'DashBoardController@index');

        // Route::resource('home', 'HomeController');

        Route::resource('products', 'ProductController');

        Route::resource('categories', 'CategoryController');

        Route::resource('units', 'UnitController');

        Route::resource('stocks', 'StockController');

        Route::resource('imports', 'ImportController');
        Route::resource('users', 'UserController');

        Route::resource('units', 'UnitsController');

        Route::resource('users', 'UserController');

        Route::resource('importItems', 'ImportItemController');

    });
    Route::resource('orders', 'OrderController');
    Route::resource('orderItems', 'OrderItemController');
    Route::resource('users', 'UserController');
    // Route::middleware('can:isStaff,can:isStaff')->group(function () {
    //     Route::resource('orders', 'OrderController');
    //     Route::resource('orderItems', 'OrderItemController');
    //     // future adminpanel routes also should belong to the group
    // });

    Route::get('pdf_order/{id}', 'OrderController@generatePdf');

    Route::get('/report_order', 'ReportController@reportOrder');
    Route::get('/report_import', 'ReportController@reportImport');
    Route::get('/report_stock', 'ReportController@reportStock');
    Route::get('/report_stock_order', 'ReportController@reportStockOrder');

    Route::get('/print_order_pdf', 'ReportController@printPdfOrder');
    Route::get('/excel_order', 'ReportController@excelOrder');

});
