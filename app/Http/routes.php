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

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');


/**
***       Admin
**/

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/eventos', ['middleware' => 'admin', 'uses' => 'AdminController@eventos']);
Route::post('/admin/eventos/crear',['middleware' => 'admin', 'uses' => 'AdminController@crearEvento']);
Route::get('/admin/evento/{id}/editar',['middleware' => 'admin', 'uses' => 'AdminController@editarEvento']);
Route::post('/admin/evento/{id}/guardarCambios',['middleware' => 'admin','uses' => 'AdminController@guardarCambiosEvento']);
Route::get('/admin/evento/{id}/getInformacion',['middleware' => 'admin', 'uses' => 'AdminController@getInfoEvento']);
Route::post('/admin/evento/{id}/eliminar',['middleware' => 'admin', 'uses' => 'AdminController@eliminarEvento']);

/**
***       Admin Proyectos
**/

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/proyectos', ['middleware' => 'admin', 'uses' => 'AdminController@proyectos']);
Route::post('/admin/proyectos/crear',['middleware' => 'admin', 'uses' => 'AdminController@crearProyecto']);
Route::get('/admin/proyecto/{id}/editar',['middleware' => 'admin', 'uses' => 'AdminController@editarProyecto']);
Route::post('/admin/proyecto/{id}/guardarCambios',['middleware' => 'admin','uses' => 'AdminController@guardarCambiosProyecto']);
Route::get('/admin/proyecto/{id}/getInformacion',['middleware' => 'admin', 'uses' => 'AdminController@getInfoProyecto']);
Route::post('/admin/proyecto/{id}/eliminar',['middleware' => 'admin', 'uses' => 'AdminController@eliminarProyecto']);

/**
***       Admin users
**/

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/users', ['middleware' => 'admin', 'uses' => 'AdminController@users']);
Route::post('/admin/proyectos/crear',['middleware' => 'admin', 'uses' => 'AdminController@crearProyecto']);
Route::get('/admin/user/{id}/editar',['middleware' => 'admin', 'uses' => 'AdminController@editarUsers']);
Route::post('/admin/user/{id}/guardarCambios',['middleware' => 'admin','uses' => 'AdminController@guardarCambiosUsers']);
Route::get('/admin/user/{id}/getInformacion',['middleware' => 'admin', 'uses' => 'AdminController@getInfoUsers']);
Route::post('/admin/user/{id}/eliminar',['middleware' => 'admin', 'uses' => 'AdminController@eliminarUsers']);