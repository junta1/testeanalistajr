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

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('clients/{data?}','\CustomerManagement\Http\Controllers\ClientController@index')->name('clients.index');
Route::get('client/{id}','\CustomerManagement\Http\Controllers\ClientController@show');
Route::post('client', '\CustomerManagement\Http\Controllers\ClientController@store');
Route::put('client/{id}', '\CustomerManagement\Http\Controllers\ClientController@update')->name('client.update');
Route::delete('client/{id}', '\CustomerManagement\Http\Controllers\ClientController@destroy')->name('client.destroy');
Route::get('client/edit/{id}', '\CustomerManagement\Http\Controllers\ClientController@edit');

Route::get('adresses/{idClient}','\CustomerManagement\Http\Controllers\AddressController@index');
Route::get('address/{id}','\CustomerManagement\Http\Controllers\AddressController@show');
Route::post('address/{idClient}','\CustomerManagement\Http\Controllers\AddressController@store');
Route::put('address/{id}','\CustomerManagement\Http\Controllers\AddressController@update');
Route::delete('address/{id}/{idClient}','\CustomerManagement\Http\Controllers\AddressController@destroy');

