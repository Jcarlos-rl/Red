@extends('layouts.app')

@section('content')
@php ($rol = $proyecto->users()->find(Auth::user()->id)->pivot->rol)
<div class="container">
    <h1> Titulo del Proyecto </h1>
    <textarea name="titulo" rows="1" cols="30">{{$proyecto->nombre}}</textarea>
    <div class="row">
      @if($rol == 'ROLE_LEADER')
        <div class="col-md-8">
      @else
        <div class="col-md-10 col-md-offset-1">
      @endif
            <div class="panel panel-default">
                <div class="panel-body">
                  <h3>Descripción</h3>
                  <textarea name="descripcion" rows="8" cols="80">{{$proyecto->descripcion}}</textarea>
                </div>
            </div>
        </div>    
    </div>
    <div class="form-group">
      {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
    </div>
</div>

@endsection
