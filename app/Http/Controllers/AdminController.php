<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
            'status' => false
        ]);

       $evento = DB::table('eventos')->select('id')->where('nombre',$request->nombre)->first(); //regresa un JSON :)

       return redirect()->action('AdminController@editarEvento', ['id' => $evento->id]);
    }

    public function editarEvento(Request $request, $id)
    {
        $evento = DB::table('eventos')->select('*')->where('id',$id)->first();

        return view('/admin/evento',['evento'=>$evento]);
    }

    public function cambiarStatus(Request $request, $id)
    {
        $evento = DB::table('eventos')->where('id',$id)->update(['status' => $request->status]);
        return json_encode('ok');
    }

    public function guardarCambiosEvento(Request $request, $id)
    {
        $nombreImagen = "";
        if($request->hasFile('imagen'))
        {
            $nombreImagen = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(base_path() . '/public/imagenesEventos/', $nombreImagen);
        }

        DB::table('eventos')->where('id',$id)->update([
                    'nombre' => $request->input('nombreEvento'),
                    'lugar'  => $request->input('lugarEvento'),
            'inicioRegistro' => $request->input('inicioRegistroEvento'),
            'fin_registro'   => $request->input('finRegistroEvento'),
            'inicio_evento'  => $request->input('inicioEvento'),
            'fin_evento'     => $request->input('finEvento'),
            'descripcion'    => $request->input('descripcionEvento'),
            'nombreImagen'   => $nombreImagen
        ]);


        return redirect('/admin/eventos');
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

    public function getInfoProyecto(Request $request, $id)
    {
        $proyectos = DB::table('proyectos')->select('*')->where('id',$id)->first();
        return json_encode($proyectos);
    }

    public function cambiarStatusProyecto(Request $request, $id)
    {
        $evento = DB::table('proyectos')->where('id',$id)->update(['status' => $request->status]);
        return json_encode('ok');
    }
	
	//Admin users
	//-------------------------------------------------------------------------------------//
	public function users()
    {
        $users = DB::table('users')->select('*')->get();
        return view('/admin/users',['users'=>$users]);
    }

    public function editarUsers(Request $request, $id)
    {
        $user = DB::table('users')->select('*')->where('id',$id)->first();

        return view('/admin/user',['user'=>$user]);
    }

    public function guardarCambiosUsers(Request $request, $id)
    {
        DB::table('users')->where('id',$id)->update([
            'name' => $request->name,
            'correo'  => $request->correo,
            'roles' => $request->roles			
        ]);

        return 'Cambios guardados exitosamente!';
    }

    public function getInfoUsers(Request $request, $id)
    {
        $user = DB::table('users')->select('*')->where('id',$id)->first();
        return json_encode($user);
    }

    public function eliminarUsers(Request $request, $id)
    {
        DB::table('users')->where('id',$id)->delete();

        return redirect('/admin/users');
    }
}
