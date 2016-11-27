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
Route::post('/getConocimientos',['middleware'=>'auth','uses'=>'HomeController@getConocimientos']);
Route::post('/actualizaConocimientos',['middleware'=>'auth','uses'=>'HomeController@actualizaConocimientos']);

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


/*User*/


Route::get('/user/eventos', 'EventoController@eventos');
Route::get('/user/evento/{id}', 'EventoController@verEvento');
Route::get('/user/proyecto/ver/{id}','EventoController@verProyecto');
Route::get('/user/evento/{id}/getInformacion', 'AdminController@getInfoEvento');
Route::get('user/evento/{id}/proyecto', 'EventoController@verProyectos');
Route::get('user/evento/proyecto/{id}, EventoController@verProyecto');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){
  Route::resource('proyectos','ProyectosController');
  Route::post('proyecto/buscarUsuario', ['as'=>'user.proyecto.buscarUsuario', 'uses' => 'ProyectosController@searchUser']);
  Route::post('proyecto/enviarCorreos', ['as'=>'user.proyecto.enviarCorreos', 'uses' => 'ProyectosController@sendEmails']);
});


/**
***       Admin users
**/

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/users', ['middleware' => 'admin', 'uses' => 'AdminController@users']);
//Route::post('/admin/users/crear',['middleware' => 'admin', 'uses' => 'AdminController@crearProyecto']);
Route::get('/admin/user/{id}/editar',['middleware' => 'admin', 'uses' => 'AdminController@editarUsers']);
Route::post('/admin/user/{id}/guardarCambios',['middleware' => 'admin','uses' => 'AdminController@guardarCambiosUsers']);
Route::get('/admin/user/{id}/getInformacion',['middleware' => 'admin', 'uses' => 'AdminController@getInfoUsers']);
Route::post('/admin/user/{id}/eliminar',['middleware' => 'admin', 'uses' => 'AdminController@eliminarUsers']);
