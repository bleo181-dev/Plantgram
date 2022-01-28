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
use App\Http\Controllers\CollaboraController;
use App\Http\Controllers\PiantaController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'SerraController@index')->name('home');

Route::get('/', 'LandingpageController@index')->name('index');

Route::resource('pianta', 'PiantaController');

Route::get('/serra/fetch_data_serre', 'SerraController@fetch_data_serre');
Route::get('serra/share/{codice_serra}', 'SerraController@indexserrashare');
Route::get('serra/collab', 'SerraController@collab')->name('invito_view');
Route::post('serra/process_collab', 'SerraController@process_collab');
Route::get('/handle_collab/{token}', 'SerraController@handle_collab')->name('handle_collab');
Route::resource('serra', 'SerraController');

Route::resource('user', 'UserController');

Route::get('/collabora/fetch_data', 'CollaboraController@fetch_data');
Route::post('/collabora/elimina', 'CollaboraController@elimina');
Route::resource('collabora', 'CollaboraController');


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
Route::put('/evento/{id}/store', 'EventoController@store');

Route::get('/forums', 'ChatterController@index');

Route::delete('/forums/{id}', 'ChatterDiscussionController@destroy');
Route::get('/forums/{id}', 'ChatterDiscussionController@index');

Route::resource('/pubblicita', 'PubblicitaController');





