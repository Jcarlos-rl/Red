<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
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

        $idProyecto = DB::table('proyectos')->where('nombre',$request->nombre)->select('id')->first();

        DB::table('users_proyectos')->insert([
                  'user_id' => Auth::user()->id,
              'proyecto_id' => $idProyecto->id,
                      'rol' => 'ROLE_LEADER'
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
            if ($user->id == $colaborador->id && $colaborador->pivot->status == 'ACCEPTED') {
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

    private function enviarCorreo(User $user, Proyecto $project)
    {
      $userLocal = Auth::user();
      Mail::send('Email.index',['local' => $userLocal, 'usuario' => $user, 'proyecto' => $project],function ($mensaje) use ($user)
      {
        $mensaje->to($user->email)
                ->subject('Invitación de colaboración de proyecto')
                ->from('betomax1636@gmail.com','Red Colaborativa');
      });
    }

    public function sendEmails(Request $request)
    {
      if ($request->ajax()) {
        $project = Proyecto::find($request->idProyecto);
        $usuarios = $project->users();
        foreach ($request->idsUsuarios as $idUser) {
          $existe = $usuarios->find($idUser);
          if ($existe) {
            $usuarios -> detach($existe) ;
            $usuarios -> attach($existe,['status' =>'WAITING']);
            $userLocal = Auth::user();
            $this->enviarCorreo($existe, $project);
          }
          else {
            $user = User::find($idUser);
            $this->enviarCorreo($user, $project);
            $user->proyectos()->attach($project);
          }
        }
        return 'Invitacion enviada';
      }
    }

    public function revisarSolicitud($value, $idUser, $idProyecto)
    {
      $proyecto = Proyecto::find($idProyecto);
      $colaborador = $proyecto->users()->find($idUser);
      if ($colaborador) {
        if ($colaborador->pivot->status == 'WAITING' ) {
          $proyecto->users()->detach($colaborador);
          $proyecto->users()->attach($colaborador, ['status' => $value]);
          return redirect()->route('welcome');
        }
        else {
          return view('users/Proyecto/SolicitudColaborador/negacion');
        }
      }
      else {
        return view('users/Proyecto/SolicitudColaborador/negacion');
      }
    }

    public function prueba()
    {
      $project = Proyecto::find(5);
      $user = User::find(1);
      //$userLocal = Auth::user();
      Mail::send('Email.index',['local' => $user, 'usuario' => $user, 'proyecto' => $project],function ($mensaje) use ($user)
      {
        $mensaje->to($user->email)
                ->subject('Invitación de colaboración de proyecto')
                ->from('entornolaravel@gmail.com','Red Colaborativa');
      });
    }

    public function eliminarColaborador($idUser,$idProyecto)
    {
      $proyecto = Proyecto::find($idProyecto);
      $user = User::find($idUser);
      $proyecto->users()->detach($user);
      return 'holi';
    }
}
