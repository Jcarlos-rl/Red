@extends('layouts.app')

@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$evento->nombre}}
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="/admin/evento/{{$evento->id}}/guardarCambios" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombreEvento" value="{{$evento->nombre}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lugar</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="lugarEvento" value="{{$evento->lugar}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Inicio Registro</label>
                            <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" name="inicioRegistroEvento" value="{{$evento->inicioRegistro}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fin Registro</label>
                            <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" name="finRegistroEvento" value="{{$evento->fin_registro}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Inicio Evento</label>
                            <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" name="inicioEvento" value="{{$evento->inicio_evento}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fin Registro</label>
                            <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" name="finEvento" value="{{$evento->fin_evento}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Imagen Evento</label>
                            <div class="col-sm-10">
                            <input type="file" class="form-control" name="imagen">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripcion</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="descripcionEvento" rows="10">{{$evento->descripcion}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button id="guardarCambios" type="submit" class="btn btn-primary form-control" >Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
