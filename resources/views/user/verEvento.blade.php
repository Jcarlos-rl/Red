@extends('layouts.app')

@section('content')

<p>Titulo: {{$evento->nombre}}</p>
<p>Lugar: {{$evento->lugar}}</p>
<p>Inicio de Registro: {{$evento->inicioRegistro}}</p>
<p>Fin de Registro: {{$evento->fin_registro}}</p>
<p>Inicio de Evento: {{$evento->inicio_evento}}</p>
<p>Fin de Evento: {{$evento->fin_evento}}</p>
<p>Descripcion: {{$evento->descripcion}}</p>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$evento->nombre}}
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lugar</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="lugarEvento" value="{{$evento->lugar}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Inicio Registro</label>
                            <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="inicioRegistroEvento" value="{{$evento->inicioRegistro}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fin Registro</label>
                            <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="finRegistroEvento" value="{{$evento->fin_registro}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Inicio Evento</label>
                            <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="inicioEvento" placeholder="{{$evento->inicioRegistro}}" value="{{$evento->inicio_evento}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fin Registro</label>
                            <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="finEvento" value="{{$evento->fin_evento}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripcion</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="descripcionEvento" rows="10">{{$evento->descripcion}}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection