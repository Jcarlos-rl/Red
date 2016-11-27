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
}
