<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Evento;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function eventos(){
         //$eventos = DB::table('eventos')->select('nombre');
         //$eventos = DB::table('eventos')->get()->paginate(4);
         $eventos = Evento::orderBy('id','ASC')->where('status',1)->paginate(5);
         return view('/user/verEventos')->with('eventos',$eventos);


     }

     public function verEvento(Request $request, $id){
         $evento = DB::table('eventos')->select('*')->where('id',$id)->first();
         //$evento = DB::table('eventos')->join('proyectos', 'proyectos.evento_id','=','eventos.id')->select('*')->where('eventos.id',$id)->first();
        return view('/user/verEvento',['evento'=>$evento]);
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
