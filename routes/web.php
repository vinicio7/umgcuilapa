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

Route::get('sedes',	'DataController@consultarSedes');
Route::get('preguntas', 'DataController@preguntas');
Route::get('galeria', 'DataController@galeria');
Route::get('informacion/universidad', 'DataController@informacionUniversidad');
Route::get('ubicacion/sedes', 'DataController@ubicacionSedes');

Route::get('actividades', 'DataController@actividades');
Route::get('informacion/sedes',	'DataController@informacionSedes');
Route::get('lista/carreras', 	'DataController@listaCarreras');

Route::get('/', function () {
    return redirect('src');
});

Route::group(['prefix' => 'ws'], function (){
	Route::resource('usuarios', 'UsuariosController');
});