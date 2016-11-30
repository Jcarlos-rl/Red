<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Proyecto;
use App\User;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $proyectos = Auth::user()->proyectos()
        ->leftJoin('eventos', 'eventos.id', '=', 'proyectos.evento_id')
        ->orderBy('id', 'ASC')
        ->select('eventos.nombre as eventoNombre','proyectos.id','proyectos.nombre','proyectos.descripcion')
        ->paginate(5);
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
        //dd($request-> all());
        $Proyecto = new Proyecto($request-> all());
        $Proyecto -> save();
        $Proyecto->users()->attach(Auth::user(),['rol' => 'ROLE_LEADER']);
        return redirect()-> route('user.proyectos.index');
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

    public function searchUser(Request $request)
    {
      if ($request->ajax()) {
        $data = User::where('name', 'LIKE', "%$request->name%")->get();
        $users = array();
        foreach ($data as $user) {
          array_push($users,['value' => $user->email, 'label' => $user->name]);
        }
        return response()->json([
          'users' => $users
        ]);
      }
    }

    public function sendEmails(Request $request)
    {
      if ($request->ajax()) {
        $texto = '';
        foreach ($request->emails as $email) {
          $texto .= $email.' ';
        }
        return $texto;
      }
    }
}
