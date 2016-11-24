<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function proyectos(){
        return view ('/user/proyectos');
    }

    public function crearProyecto(Request $request){
         DB::table('proyectos')->insert([
            'nombre' => $request->nombre,
        ]);

       $proyecto = DB::table('proyectos')->select('id')->where('nombre',$request->nombre)->first(); //regresa un JSON :)
      
       return redirect()->action('ProyectoController@editarProyecto', ['id' => $proyecto->id]);
    }

    public function editarProyecto(Request $request, $id){
       $proyecto = DB::table('proyectos')->select('*')->where('id',$id)->first();
        return view('/user/proyecto',['proyecto'=>$proyecto]);
    }


    public function guardarCambiosProyecto(Request $request, $id){
          DB::table('proyectos')->where('id',$id)->update([
            'nombre' => $request->nombre,
            'descripcion'    => $request->descripcion,
            'evento_id'  => $request->evento_id
        ]);

        /*$id_user = Sentry::get_current_user()->id;
        DB::table('users_proyectos')->insert([
            'user_id' => $request->$user->$id_user,
            'proyecto_id'    => $request->$id,
            'fecha_registro'  => Carbon\Carbon::now(),
            'rol' => 'LIDER'
        ]);*/


        return 'Cambios guardados exitosamente!';
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
