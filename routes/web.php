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

Route::resource('/books','bookController');
Route::post('export', 'bookController@export')->name('export');
Route::post('exportxml','bookController@exportxml')->name('exportxml');

// Route::get('export', 'bookController@excelExport')->name('export');
// Route::get('export.csv', 'bookController@cvsExport')->name('export.csv');

