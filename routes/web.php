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

use App\Http\Controllers\UserController;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'LandingpageController@index')->name('index');

Route::resource('pianta', 'PiantaController');

Route::resource('serra', 'SerraController');

Route::resource('user', 'UserController');

Route::get('/bisogno/{codice_pianta}', 'BisognoController@index')->name('bisogno.index');
Route::get('/bisogno/{codice_pianta}/create', 'BisognoController@create');
Route::post('/bisogno/{codice_pianta}/store', 'BisognoController@store');
Route::delete('/bisogno/{codice_pianta}', 'BisognoController@destroy');
Route::get('/bisogno/{codice_pianta}/edit', 'BisognoController@edit');
Route::patch('/bisogno/{codice_pianta}/update', 'BisognoController@update');

Route::get('/diario/{id}', 'DiarioController@index');
Route::get('/diario/{id}/create', 'DiarioController@create');
Route::post('/diario/{id}/store', 'DiarioController@store');
Route::delete('/diario/{id}', 'DiarioController@destroy');
Route::get('/diario/{id}/edit', 'DiarioController@edit');
Route::put('/diario/{id}/update', 'DiarioController@update');

Route::get('/evento/{id}', 'EventoController@index');
Route::put('/evento/{id}/update', 'EventoController@update');
