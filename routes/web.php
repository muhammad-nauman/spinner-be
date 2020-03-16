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
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resources([
        'products' => 'ProductController',
        'products.inventories' => 'InventoryController',
        'machines' => 'MachineController'
    ]);

    Route::get('barcodes', 'BarcodeController@index')->name('barcodes.index');
});
