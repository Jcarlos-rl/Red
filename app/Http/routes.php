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
Route::get('/', ['as'=>'welcome', function () {
    return view('welcome');
}]);
/*
   Rutas de Inicio Sesion
*/
/* OJO... PROHIBIDO MANIPULAR */
Route::auth();
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
/*User*/
Route::post('/getConocimientos',['middleware'=>'auth','uses'=>'HomeController@getConocimientos']);
Route::post('/actualizaConocimientos',['middleware'=>'auth','uses'=>'HomeController@actualizaConocimientos']);
Route::post('/getMisConocimientos',['middleware'=>'auth','uses'=>'HomeController@getMisConocimientos']);
Route::post('/eliminaConocimiento',['middleware'=>'auth','uses'=>'HomeController@eliminaConocimiento']);
Route::get('/user/configuracion',['middleware'=>'auth','uses'=>'HomeController@configuracion']);
Route::post('/user/actualizaDatosUsuario',['middleware'=>'auth', 'uses'=>'HomeController@actualizaDatosUsuario']);

/*Route::post('/user/buscarNombre',['middleware' => 'auth', 'uses' =>'HomeController@buscarNombre']);
Route::post('/user/buscarConocimiento',['middleware' => 'auth', 'uses' =>'HomeController@buscarConocimiento']);*/
Route::post('/user/subirImagenPerfil',['middleware'=>'auth','uses'=>'HomeController@subirImagenPerfil']);
Route::post('/user/getListaDestinatarios',['middleware'=>'auth','uses'=>'HomeController@getListaDestinatarios']);
Route::post('/user/nuevoMensaje',['middleware'=>'auth','uses'=>'HomeController@nuevoMensaje']);
Route::post('/user/bandejaEntrada/',['middleware'=>'auth','uses'=>'HomeController@bandejaEntrada']);
Route::post('/user/bandejaLeidos/',['middleware'=>'auth','uses'=>'HomeController@bandejaLeidos']);
Route::post('/user/verMensaje',['middleware'=>'auth','uses'=>'HomeController@verMensaje']);
Route::post('/user/cambiarColor',['middleware'=>'auth','uses'=>'HomeController@cambiarColor']);


Route::get('/user/eventos',['middleware'=>'auth','uses'=>'EventoController@eventos']);
Route::get('/user/evento/{id}',['middleware'=>'auth','uses'=>'EventoController@verEvento']);
Route::get('/user/evento/{id}/proyecto',['middleware'=>'auth','uses'=>'EventoController@verProyectos']);
Route::get('/user/evento/proyecto/{id}',['middleware'=>'auth','uses'=>'EventoController@verProyecto']);

Route::post('/user/evento/agregarProyecto',['middleware' => 'auth', 'uses'=>'EventoController@agregarProyecto']);
Route::post('/user/evento/agregarEvento',['middleware' => 'auth', 'uses' => 'EventoController@agregarEvento']);
Route::post('/user/evento/sacarProyecto',['middleware' => 'auth', 'uses' => 'EventoController@sacarProyecto']);

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){
  Route::resource('proyectos','ProyectosController');
  Route::post('proyecto/buscarUsuario', ['as'=>'user.proyecto.buscarUsuario', 'uses' => 'ProyectosController@searchUsers']);
  Route::post('proyecto/buscarConocimiento', ['as'=>'user.proyecto.buscarConocimiento', 'uses' => 'ProyectosController@searchConoimientos']);
  Route::post('proyecto/enviarCorreos', ['as'=>'user.proyecto.enviarCorreos', 'uses' => 'ProyectosController@sendEmails']);
  Route::post('/proyecto/sacarProyecto', ['as'=>'user.proyecto.sacarProyecto', 'uses' => 'ProyectosController@sacarProyecto']);
  Route::delete('proyecto/eliminarColaborador/{idUser}/{idProyecto}', ['as'=>'user.proyecto.eliminarColaborador', 'uses' => 'ProyectosController@eliminarColaborador']);
});
/*
Route::post('/proyecto/buscarUsuario', ['as'=>'user.proyecto.buscarUsuario', 'uses' => 'ProyectosController@searchUser']);
Route::post('/proyecto/enviarCorreos', ['as'=>'user.proyecto.enviarCorreos', 'uses' => 'ProyectosController@sendEmails']);
Route::post('/proyecto/sacarProyecto', ['as'=>'user.proyecto.sacarProyecto', 'uses' => 'ProyectosController@sacarProyecto']);

*/
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
/**
***       Admin Proyectos
**/

Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/proyectos', ['middleware' => 'admin', 'uses' => 'AdminController@proyectos']);
Route::get('/admin/proyecto/{id}/getInformacion',['middleware' => 'admin', 'uses' => 'AdminController@getInfoProyecto']);
Route::post('/admin/proyecto/{id}/cambiarStatusProyecto',['middleware'=>'auth','uses'=>'AdminController@cambiarStatusProyecto']);
/**
***       Admin users
**/
Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/admin/users', ['middleware' => 'admin', 'uses' => 'AdminController@users']);
//Route::post('/admin/proyectos/crear',['middleware' => 'admin', 'uses' => 'AdminController@crearProyecto']);
Route::get('/admin/user/{id}/editar',['middleware' => 'admin', 'uses' => 'AdminController@editarUsers']);
Route::post('/admin/user/{id}/guardarCambios',['middleware' => 'admin','uses' => 'AdminController@guardarCambiosUsers']);
Route::get('/admin/user/{id}/getInformacion',['middleware' => 'admin', 'uses' => 'AdminController@getInfoUsers']);
Route::post('/admin/user/{id}/eliminar',['middleware' => 'admin', 'uses' => 'AdminController@eliminarUsers']);
