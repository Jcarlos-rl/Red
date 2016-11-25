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

Route::get('/home', 'HomeController@index');
Route::get('/eventos','HomeController@eventos');





/*
    Rutas de ADMIN
*/

/*OJO... middleware => admin ... identifica derechos de admin, sino bloquea la ruta... solo usar en rutas de ADMIN */

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/eventos', ['middleware' => 'admin', 'uses' => 'AdminController@eventos']);
Route::post('/admin/eventos/crear',['middleware' => 'admin', 'uses' => 'AdminController@crearEvento']);
Route::get('/admin/evento/{id}/editar',['middleware' => 'admin', 'uses' => 'AdminController@editarEvento']);
Route::post('/admin/evento/{id}/cambiarStatus',['middleware' => 'admin', 'uses' => 'AdminController@cambiarStatus']);
Route::post('/admin/evento/{id}/guardarCambios',['middleware' => 'admin','uses' => 'AdminController@guardarCambiosEvento']);
Route::get('/admin/evento/{id}/getInformacion',['middleware' => 'admin', 'uses' => 'AdminController@getInfoEvento']);
Route::post('/admin/evento/{id}/eliminar',['middleware' => 'admin', 'uses' => 'AdminController@eliminarEvento']);


/*User*/

Route::get('/user/proyectos', 'ProyectoController@proyectos');
Route::post('user/proyectos/crear', 'ProyectoController@crearProyecto');
Route::get('/user/proyecto/{id}','ProyectoController@editarProyecto');
Route::post('/user/proyecto/{id}/guardarCambios','ProyectoController@guardarCambiosProyecto');
Route::get('/user/eventos', 'EventoController@eventos');
Route::get('/user/evento/{id}', 'EventoController@verEvento');
Route::get('/user/proyecto/ver/{id}','ProyectoController@verProyecto');
Route::get('/user/evento/{id}/getInformacion', 'AdminController@getInfoEvento');

