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

//Dashboard
Route::get('/dashboard', 'DashboardController@index');
Route::get('/peticiones/cargarTablaNoAtendidas', 'PeticionesController@cargarTablaNoAtendidas');


//Peticiones
Route::get('/peticiones/cargarTabla', 'PeticionesController@cargarTabla');Route::get('/peticiones/{id_peticion}/delete', 'PeticionesController@delete');
Route::get('/peticiones/{id_peticion}/atender', 'PeticionesController@atender');
Route::put('/peticiones/{id_peticion}/atenderPeticion', 'PeticionesController@atenderPeticion');
Route::resource('/peticiones', 'PeticionesController');

//Reportes
Route::get("/reportes", 'ReportesController@index');
Route::get("/reportes/{latitud}/{longitud}", 'ReportesController@obtenerPeticiones');

Auth::routes();
