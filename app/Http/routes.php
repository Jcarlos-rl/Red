<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');





/**
***       Admin
**/

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/eventos', ['middleware' => 'admin', 'uses' => 'AdminController@eventos']);
Route::post('/admin/eventos/crear',['middleware' => 'admin', 'uses' => 'AdminController@crearEvento']);
Route::get('/admin/evento/{id}',['middleware' => 'admin', 'uses' => 'AdminController@editarEvento']);
Route::post('/admin/evento/{id}/guardarCambios',['middleware' => 'admin','uses' => 'AdminController@guardarCambiosEvento']);



/*User*/

Route::get('/user/proyectos', 'ProyectoController@proyectos');
Route::post('user/proyectos/crear', 'ProyectoController@crearProyecto');
Route::get('/user/proyecto/{id}','ProyectoController@editarProyecto');
Route::post('/user/proyecto/{id}/guardarCambios','ProyectoController@guardarCambiosProyecto');
Route::get('/user/eventos', 'EventoController@eventos');
Route::get('/user/evento/{id}', 'EventoController@verEvento');
Route::get('/user/proyecto/ver/{id}','ProyectoController@verProyecto');