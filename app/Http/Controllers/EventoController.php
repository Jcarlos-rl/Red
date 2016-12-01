<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Evento;
use App\Proyecto;
use App\User;


class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function eventos(){
         $eventos = Evento::orderBy('id','ASC')->where('status',1)->paginate(5);
         return view('/users/Evento/verEventos')->with('eventos',$eventos);


     }

     public function verEvento(Request $request, $id){
         $evento = DB::table('eventos')->select('*')->where('id',$id)->first();
        return view('/users/Evento/verEvento',['evento'=>$evento]);
     }

     public function verProyectos(Request $request, $id){

        $proyectos = DB::table('proyectos')->join('eventos','proyectos.evento_id','=','eventos.id')->where('eventos.id',$id)
        ->where('proyectos.status','ACCEPTED')
        ->select('proyectos.*')->get();

        return view('users/Evento/proyectos')->with('proyectos', $proyectos);
     }
    public function index()
    {
        //
    }
     public function getInfoEvento(Request $request, $id)
    {
        $eventos = DB::table('eventos')->select('*')->where('id',$id)->first();
        return json_encode($eventos);
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
    public function agregarProyecto(Request $request){
        $proyecto = DB::table('proyectos')->where('id',$request->id)->update(['evento_id'=>$request->evento]);
        return json_encode("Almacenado Correctamente");
        //return view('users/Evento/proyectos');
    }

    //Funcion para llenar los select con todos los eventos
    public function agregarEvento(){
        $eventos = DB::table('eventos')->where('status',1)->get();
        return json_encode($eventos);
    }

    public function sacarProyecto(Request $request){
        $project= DB::table('proyectos')->where('id',$request->id)->update(['evento_id'=>NULL]);

       return json_encode("Bien");
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
