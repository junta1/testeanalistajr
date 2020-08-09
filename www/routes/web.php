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
    return view('auth.login');
});

Auth::routes();

Route::resource('client', '\CustomerManagement\Http\Controllers\ClientController');
Route::get('clients/{data?}', '\CustomerManagement\Http\Controllers\ClientController@index')->name('clients.index');
Route::get('client/edit/{id}', '\CustomerManagement\Http\Controllers\ClientController@edit');

Route::resource('address', '\CustomerManagement\Http\Controllers\AddressController');
Route::get('adresses/{idClient}', '\CustomerManagement\Http\Controllers\AddressController@index');
Route::get('address/create/{idClient}', '\CustomerManagement\Http\Controllers\AddressController@create');
Route::post('address/client/{idClient}', '\CustomerManagement\Http\Controllers\AddressController@store')->name('address.client');
Route::delete('address/{id}/{idClient}', '\CustomerManagement\Http\Controllers\AddressController@destroy')->name('address.destroy');

