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

/*
    Rutas PUBLICAS
*/

/* OJO.. AQUI no es necesario enviar a un controlador... la informacion sera estatica en las vistas a renderizar */

Route::get('/', function () {
    return view('welcome');
});

/*
   Rutas de Inicio Sesion
*/

/* OJO... PROHIBIDO MANIPULAR */
Route::auth();
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');



/*
    Rutas de USUARIO
*/
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){
  Route::resource('eventos','HomeController@eventos');
  Route::resource('configuracion','HomeController@configuracion');
  Route::resource('proyectos','ProyectosController');
});

Route::post('/user/actualizaDatosUsuario',['middleware'=>'auth', 'uses'=>'HomeController@actualizaDatosUsuario']);



/*
    Rutas de ADMIN
*/

/*OJO... middleware => admin ... identifica derechos de admin, sino bloquea la ruta... solo usar en rutas de ADMIN */
/**
***       Admin
**/

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/eventos', ['middleware' => 'admin', 'uses' => 'AdminController@eventos']);
Route::post('/admin/eventos/crear',['middleware' => 'admin', 'uses' => 'AdminController@crearEvento']);
Route::get('/admin/evento/{id}/editar',['middleware' => 'admin', 'uses' => 'AdminController@editarEvento']);
Route::post('/admin/evento/{id}/cambiarStatus',['middleware' => 'admin', 'uses' => 'AdminController@cambiarStatus']);
Route::post('/admin/evento/{id}/guardarCambios',['middleware' => 'admin','uses' => 'AdminController@guardarCambiosEvento']);
Route::get('/admin/evento/{id}/getInformacion',['middleware' => 'admin', 'uses' => 'AdminController@getInfoEvento']);
Route::post('/admin/evento/{id}/eliminar',['middleware' => 'admin', 'uses' => 'AdminController@eliminarEvento']);

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/proyectos', ['middleware' => 'admin', 'uses' => 'AdminController@proyectos']);
Route::post('/admin/proyectos/crear',['middleware' => 'admin', 'uses' => 'AdminController@crearProyecto']);
Route::get('/admin/proyecto/{id}/editar',['middleware' => 'admin', 'uses' => 'AdminController@editarProyecto']);
Route::post('/admin/proyecto/{id}/guardarCambios',['middleware' => 'admin','uses' => 'AdminController@guardarCambiosProyecto']);
Route::get('/admin/proyecto/{id}/getInformacion',['middleware' => 'admin', 'uses' => 'AdminController@getInfoProyecto']);
Route::post('/admin/proyecto/{id}/eliminar',['middleware' => 'admin', 'uses' => 'AdminController@eliminarProyecto']);
