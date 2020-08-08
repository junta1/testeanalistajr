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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('clients/{data?}','\CustomerManagement\Http\Controllers\ClientController@index');
Route::get('client/{id}','\CustomerManagement\Http\Controllers\ClientController@show');
Route::post('client', '\CustomerManagement\Http\Controllers\ClientController@store');
Route::put('client/{id}', '\CustomerManagement\Http\Controllers\ClientController@update');
Route::delete('client/{id}', '\CustomerManagement\Http\Controllers\ClientController@destroy');
