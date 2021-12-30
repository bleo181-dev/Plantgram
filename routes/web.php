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

use App\Http\Controllers\PiantaController;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PiantaController@index')->name('index');  //solo per adesso in mancanza di una landing page

Route::resource('pianta', 'PiantaController');

Route::resource('serra', 'SerraController');

Route::get('/diario/{id}', 'DiarioController@index');
Route::get('/diario/{id}/create', 'DiarioController@create');
Route::post('/diario/{id}/store', 'DiarioController@store');
Route::delete('/diario/{id}', 'DiarioController@destroy');
Route::get('/diario/{id}/edit', 'DiarioController@edit');
Route::put('/diario/{id}/update', 'DiarioController@update');

/*
Route::get('/pianta', 'PiantaController@create');
Route::get('/pianta/{id}', 'PiantaController@show');
Route::post('/pianta', 'PiantaController@index');
*/