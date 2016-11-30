<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use Session;
use redirect;

use App\Http\Requests;
use App\Proyecto;
use App\User;
use App\Conocimiento;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $proyectos = Auth::user()->proyectos()->orderBy('id', 'ASC')->paginate(5);
      return view('users/Proyecto/listProyectos')->with('proyectos', $proyectos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.Proyecto.ViewAgregarP');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $nombreImagen = "";
        if($request->hasFile('imagenProyecto'))
        {
            $nombreImagen = $request->file('imagenProyecto')->getClientOriginalName();
            $request->file('imagenProyecto')->move(base_path() . '/public/imagenesProyectos/', $nombreImagen);
        }

        DB::table('proyectos')->insert([
                    'nombre' => $request->nombre,
               'descripcion' => $request->descripcion,
            'imagenProyecto' => $nombreImagen
        ]);


        return redirect('/user/proyectos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $proyecto = Proyecto::find($id);
      return view('users/Proyecto/verProyecto')->with('proyecto', $proyecto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = Proyecto::find($id);
        return view('users/Proyecto/ViewEditarP')->with('proyecto', $proyecto);
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
        $Proyecto = Proyecto::find($id);
        $Proyecto->nombre=$request->nombre;
        $Proyecto->descripcion=$request->descripcion;
        $Proyecto->save();
        return redirect()-> route('user.proyectos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $proyecto = Proyecto::find($id);
      $nombre = $proyecto->nombre;
      if ($request->ajax()) {
        $proyecto->delete();
        return response()->json([
          'message' => 'proyecto '.$nombre.' eliminado exitosamente'
        ]);
      }
      flash('proyecto '.$nombre.' eliminado exitosamente', 'success');
      return redirect()->route('user.proyectos.index');
    }

    public function searchConoimientos(Request $request)
    {
      if ($request->ajax()) {
        $data = Conocimiento::where('nombre', 'LIKE', "%$request->name%")->get();
        $conocimientos = array();
        foreach ($data as $conocimiento) {
          array_push($conocimientos,['value' => $conocimiento->id, 'label' => $conocimiento->nombre]);
        }
        return response()->json([
          'conocimientos' => $conocimientos
        ]);
      }
    }

    public function searchUsers(Request $request)
    {
      $colaboradores = Proyecto::find($request->idProyecto)->users;
      if ($request->ajax()) {
        $conocimiento = Conocimiento::find($request->id);
        $data = $conocimiento->users;
        $users = array();
        foreach ($data as $user) {
          $bandera = false;
          foreach ($colaboradores as $colaborador) {
            if ($user->id == $colaborador->id) {
              $bandera = true;
              break;
            }
          }
          if ($bandera == false) {
            array_push($users,$user);
          }
        }
        return response()->json([
          'users' => $users
        ]);
      }
    }

    public function sendEmails(Request $request)
    {
      if ($request->ajax()) {
        $project = Proyecto::find($request->idProyecto);
        foreach ($request->idsUsuarios as $idUser) {
          $user = User::find($idUser);
          $user->proyectos()->attach($project);
        }
        return 'Invitacion enviada';
      }
    }

    public function prueba()
    {
      Mail::send('Email.index',[],function ($mensaje)
      {
        $mensaje->to('appjak34@gmail.com');
      });
    }
}
