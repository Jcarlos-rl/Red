<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/admin/index');
    }

    public function eventos()
    {
        $eventos = DB::table('eventos')->select('*')->get();
        return view('/admin/eventos',['eventos'=>$eventos]);
    }

    public function crearEvento(Request $request)
    {
        DB::table('eventos')->insert([
            'nombre' => $request->nombre,
        ]);

       $evento = DB::table('eventos')->select('id')->where('nombre',$request->nombre)->first(); //regresa un JSON :)
      
       return redirect()->action('AdminController@editarEvento', ['id' => $evento->id]);
    }

    public function editarEvento(Request $request, $id)
    {
        $evento = DB::table('eventos')->select('*')->where('id',$id)->first();

        return view('/admin/evento',['evento'=>$evento]);
    }

    public function guardarCambiosEvento(Request $request, $id)
    {
        DB::table('eventos')->where('id',$id)->update([
            'nombre' => $request->nombre,
            'lugar'  => $request->lugar,
            'inicioRegistro' => $request->inicioRegistro,
            'fin_registro'   => $request->fin_registro,
            'inicio_evento'  => $request->inicio_evento,
            'fin_evento'     => $request->fin_evento,
            'descripcion'    => $request->descripcion
        ]);

        return 'Cambios guardados exitosamente!';
    }

    public function getInfoEvento(Request $request, $id)
    {
        $eventos = DB::table('eventos')->select('*')->where('id',$id)->first();
        return json_encode($eventos);
    }

    public function eliminarEvento(Request $request, $id)
    {
        DB::table('eventos')->where('id',$id)->delete();

        return redirect('/admin/eventos');
    }
	
	//-------------------------------------------------------------------------------------//
	public function proyectos()
    {
        $proyectos = DB::table('proyectos')->select('*')->get();
        return view('/admin/proyectos',['proyectos'=>$proyectos]);
    }

    public function crearProyecto(Request $request)
    {
        DB::table('proyectos')->insert([
            'nombre' => $request->nombre,
        ]);

       $proyecto = DB::table('proyectos')->select('id')->where('nombre',$request->nombre)->first(); //regresa un JSON :)
      
       return redirect()->action('AdminController@editarProyecto', ['id' => $proyecto->id]);
    }

    public function editarProyecto(Request $request, $id)
    {
        $proyecto = DB::table('proyectos')->select('*')->where('id',$id)->first();

        return view('/admin/proyecto',['proyecto'=>$proyecto]);
    }

    public function guardarCambiosProyecto(Request $request, $id)
    {
        DB::table('proyectos')->where('id',$id)->update([
            'nombre' => $request->nombre,
            'descripcion'  => $request->descripcion,
            'evento_id' => $request->evento_id			
        ]);

        return 'Cambios guardados exitosamente!';
    }

    public function getInfoProyecto(Request $request, $id)
    {
        $proyectos = DB::table('proyectos')->select('*')->where('id',$id)->first();
        return json_encode($proyectos);
    }

    public function eliminarProyectos(Request $request, $id)
    {
        DB::table('proyectos')->where('id',$id)->delete();

        return redirect('/admin/proyectos');
    }
}
