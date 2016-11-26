@extends('layouts.app')

@section('content')

<div class="container">
    <h2>{{$evento->nombre}}</h2>
    <div class="panel-group">
        <div class="panel panel-success">
            <div class="panel-heading">
                Descripcion
            </div>
            <div class="panel-body">
                <div class="col-sm-8">
                    {{$evento->descripcion}}
                </div>
                <div class="col-sm-4">
                    <img src="{{ asset( 'imagenesEventos/' . $evento->nombreImagen)}}" style ="height:300px; width=:200px" >
                </div>
            </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-success">
            <div class="panel-heading">
                Lugar
            </div>
            <div class="panel-body">
                {{$evento->lugar}}      
            </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-success">
            <div class="panel-heading">
                Inicio de Registro
            </div>
            <div class="panel-body">
                {{$evento->inicioRegistro}}      
            </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-success">
            <div class="panel-heading">
                Fin de Registro
            </div>
            <div class="panel-body">
                {{$evento->fin_registro}}      
            </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-success">
            <div class="panel-heading">
                Inicio de Evento
            </div>
            <div class="panel-body">
                {{$evento->inicio_evento}}      
            </div>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-success">
            <div class="panel-heading">
                Fin del Evento
            </div>
            <div class="panel-body">
                {{$evento->fin_evento}}      
            </div>
        </div>
    </div>
</div>

@endsection