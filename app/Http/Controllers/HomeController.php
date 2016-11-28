<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Evento;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     
    public function eventos()
    {
         $eventos = Evento::orderBy('id','ASC')->where('status',1)->paginate(5);
         return view('/user/verEventos')->with('eventos',$eventos);
    }

    public function configuracion()
    {
        return view('users/configuracionCuenta',['user' => Auth::user()]);
    }

    public function actualizaDatosUsuario(Request $request)
    {
        DB::table('users')->where('email',Auth::user()->email)->update(['name'=>$request->nombre]);
        return json_encode("Datos Actualizados correctamente");
    }

    public function getConocimientos()
    {
        $conocimientos = DB::table('conocimientos')->select('*')->get();
        return json_encode($conocimientos);
    }

    public function getMisConocimientos()
    {
        //Necesito el id del usuario para otorgarle el conocimiento 
        $idUser = DB::table('users')->where('email',Auth::user()->email)->select('id')->first();
        
        $misConocimientos = DB::table('conocimientos')->join('users_conocimientos','conocimientos.id','=','users_conocimientos.conocimiento_id')
                                                      ->join('users','users.id','=','users_conocimientos.user_id')
                                                      ->where('users_conocimientos.user_id',$idUser->id)->select('conocimientos.nombre','users_conocimientos.conocimiento_id')->get();
        return json_encode($misConocimientos);
    }
    public function actualizaConocimientos(Request $request)
    {
        //Existe actualmente este conocimiento?
        $existeConocimiento = DB::table('conocimientos')->where('nombre',$request->conocimiento)->select('id')->get();
        if(!sizeOf($existeConocimiento)>0) //Si no existe entonces lo guardo
        {
           DB::table('conocimientos')->insert([
               'nombre' => $request->conocimiento
           ]);
        }       
        //Necesito el id del usuario para otorgarle el conocimiento 
        $idUser = DB::table('users')->where('email',Auth::user()->email)->select('id')->first();

        //Necesito el id del conocimiento para otorgarle el usuario
        $idConocimiento = DB::table('conocimientos')->where('nombre',$request->conocimiento)->select('id')->first();

        //El usuario actualmente ya cuenta con este conocimiento?
        $yaTieneConocimiento = DB::table('users')->join('users_conocimientos','users.id','=','users_conocimientos.user_id')
                                                 ->join('conocimientos','conocimientos.id','=','users_conocimientos.conocimiento_id')
                                                 ->where('users_conocimientos.user_id',$idUser->id)
                                                 ->where('users_conocimientos.conocimiento_id',$idConocimiento->id)
                                                 ->select('users.id')->get();
        if(!sizeOf($yaTieneConocimiento)) //Si no tiene este conocimiento entonces
        {
            //Guardo el conocimiento al usuario en tabla users_conocimientos
            DB::table('users_conocimientos')->insert([
                'user_id' => $idUser->id,
                'conocimiento_id' => $idConocimiento->id
            ]);
        }

        //Actualizo los conocimientos al usuario 
        $conocimientos = DB::table('conocimientos')->select('*')->get();
        return json_encode($conocimientos);
    }
    public function eliminaConocimiento(Request $request)
    {
        //Necesito el id del usuario para otorgarle el conocimiento 
        $idUser = DB::table('users')->where('email',Auth::user()->email)->select('id')->first();
        
        DB::table('users_conocimientos')->where('conocimiento_id',$request->idConocimiento)
                                        ->where('user_id',$idUser->id)->delete();
        return "OK";
    }

    public function buscarNombre(Request $request){
        $users = DB::table('users')->where('nombre',$request->nombre);
        return json_encode($users);
    }

}
