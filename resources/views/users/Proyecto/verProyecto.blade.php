@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
@endsection
@section('content')
@php ($rol = $proyecto->users()->find(Auth::user()->id)->pivot->rol)
<div class="container">
    <h1>{{$proyecto->nombre}}</h1>
    <div class="row">
      @if($rol == 'ROLE_LEADER')
        <div class="col-md-8">
      @else
        <div class="col-md-10 col-md-offset-1">
      @endif
            <div class="panel panel-default">
                <div class="panel-body">
                  <h3>Descripción</h3>
                  <textarea name="descripcion" rows="11" cols="80" readonly>{{$proyecto->descripcion}}</textarea>
                </div>
            </div>
        </div>
        @if($rol == 'ROLE_LEADER')
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                  <h3>Buscar Colaborador</h3>
                  <div class="form-group">
                    {!! Form::label('nombre', 'Conocimiento') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Conocimiento...', 'id' => 'collaboratorText', 'autocomplete'=>'off']) !!}
                  </div>
                  <table class="table table-striped">
                    <thread>
                        <tr>
                            <th class="text-center">Nombre</th>
                        </tr>
                    </thread>
                    <tbody id="collaborators">
                    </tbody>
                  </table>
                  <table class="table table-striped">
                    <thread>
                        <tr>
                            <th class="text-center">Nombre</th>
                        </tr>
                    </thread>
                    <tbody id="selectedCollaborators">
                    </tbody>
                  </table>
                  <div class="form-group">
                    <button class="btn btn-success" type="button" style="width:100%;" name="btnSend" id="btnSend">Invitar</button>
                  </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                  <h3>Colaboradores</h3>
                  <table class="table table-striped">
                    <thread>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thread>
                    <tbody>
                      @foreach($proyecto->users as $usuario)
                        @if($usuario->pivot->status != 'REJECTED')
                          <tr id="{{$usuario->id}}">
                            <th class="text-center">{{$usuario->name}}</th>
                            <th class="text-center">
                              @if($usuario->pivot->rol == 'ROLE_LEADER')
                                <span class="label label-success">Lider</span>
                              @else
                                <span class="label label-primary">Colaborador</span>
                              @endif
                            </th>
                            <th class="text-center"><span class="label label-info">{{$usuario->pivot->status}}</span></th>
                            @if($usuario->pivot->rol == 'ROLE_LEADER')
                              <th class="text-center"><button type="button" name="button" class="btn btn-danger btn-sm disabled"><span class="glyphicon glyphicon-remove"></span></button></th>
                            @else
                              <th class="text-center"><button type="button" name="button" class="btn btn-danger btn-sm btn-delete"><span class="glyphicon glyphicon-remove"></span></button></th>
                            @endif
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
              {!! Form::open(['route' => ['user.proyecto.eliminarColaborador', 'ID_COLABORADOR', $proyecto->id], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
              {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('javascripts')
  <script src="{{ asset('js/bootbox.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-ui.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/proyectos/search-collaborator.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/proyectos/send-invitation.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/proyectos/deletecolaborador.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    var token = '{{ Session::token() }}';
    var template = '@include("users/templates/filaColaborador")';
    var idProject = '{{ $proyecto->id }}'
  </script>


@endsection
