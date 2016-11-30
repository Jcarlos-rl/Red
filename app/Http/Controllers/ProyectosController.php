<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //dd($request-> all());
        $Proyecto = new Proyecto($request-> all());
        $Proyecto -> save();
        $Proyecto->users()->attach(Auth::user(),['rol' => 'ROLE_LEADER', 'status' => 'ACCEPTED']);
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

    private function enviarCorreo($user)
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
        foreach ($request->idsUsuarios as $idUser) {
          $usuarios = $project->users();
          $existe = $usuarios->find($idUser);
          if ($existe) {
            $usuarios -> detach($existe) ;
            $usuarios -> attach($existe,['status' =>'WAITING']);
            $userLocal = Auth::user();
            Mail::send('Email.index',['local' => $userLocal, 'usuario' => $existe, 'proyecto' => $project],function ($mensaje) use ($existe)
            {
              $mensaje->to($existe->email)
                      ->subject('Invitación de colaboración de proyecto')
                      ->from('betomax1636@gmail.com','Red Colaborativa');
            });
            //$this->enviarCorreo($existe);
          }
          else {
            $user = User::find($idUser);
            $userLocal = Auth::user();
            Mail::send('Email.index',['local' => $userLocal, 'usuario' => $user, 'proyecto' => $project],function ($mensaje) use ($user)
            {
              $mensaje->to($user->email)
                      ->subject('Invitación de colaboración de proyecto')
                      ->from('betomax1636@gmail.com','Red Colaborativa');
            });
            //$this->enviarCorreo($user);
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
