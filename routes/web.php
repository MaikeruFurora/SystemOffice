<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/transfer-year', 'TransferController@year');
Route::get('/transfer-filterYear/{year}', 'TransferController@filterYear');
Route::get('/transfer/{month}/{year}', 'TransferController@index');
Route::post('/transfer-post', 'TransferController@store');
Route::get('/transfer-print/{month}/{year}/{status}', 'TransferController@printReport');
Route::delete('/transfer-delete/{id}', 'TransferController@destroy');
Route::put('/transfer-edit/{id}', 'TransferController@edit');
Route::get('/transfer-wholeYear/{year}', 'TransferController@wholeYear');
Route::get('/transfer-perMonth/{month}/{year}', 'TransferController@perMonth');
