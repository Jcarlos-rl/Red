@extends('layouts.app')

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
                  <textarea name="descripcion" rows="8" cols="80" readonly>{{$proyecto->descripcion}}</textarea>
                </div>
            </div>
        </div>
        @if($rol == 'ROLE_LEADER')
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                  <h3>Buscar Colaborador</h3>
                  {!! Form::open(['method' => 'POST']) !!}
                  <div class="form-group">
                    {!! Form::label('nombre', 'nombre') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre...']) !!}
                  </div>
                  <table class="table table-striped">
                    <thread>
                        <tr>
                            <th class="text-center">Nombre</th>
                        </tr>
                    </thread>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="form-group">
                    {!! Form::submit('Invitar', ['class' => 'btn btn-success']) !!}
                  </div>
                  {!! Form::close() !!}
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
                        </tr>
                    </thread>
                    <tbody>
                      @foreach($proyecto->users as $usuario)
                        <tr id="{{$usuario->id}}">
                          <th class="text-center">{{$usuario->name}}</th>
                          <th class="text-center">
                            @if($usuario->pivot->rol == 'ROLE_LEADER')
                              <span class="label label-success">Lider</span>
                            @else
                              <span class="label label-primary">Colaborador</span>
                            @endif
                          </th>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
