@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container">
        <div class="container-fluid col-sm-10" >
            <h2>{{$evento->nombre}}</h2>
        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-success">
            <div class="panel-heading">
                Descripcion 
            </div>
            <div class="panel-body">
                <div class="col-sm-8">
                    <div>
                    {{$evento->descripcion}}
                    </div>
                    <br/>
                    <div class="text-bottom">
                    <button class="btn btn-success" id="proyectos">Ver Proyectos</button>
                    </div>
                </div>
                  <div class="col-sm-3">
                    <img src="{{ asset( 'imagenesEventos/' . $evento->nombreImagen)}}" style ="height:13em; ">
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

<script>
    $(document).ready(function(){
        $('#proyectos').click(function(){
            window.location.href="{{$evento->id}}/proyecto";
        });
    });
 
</script>
@endsection