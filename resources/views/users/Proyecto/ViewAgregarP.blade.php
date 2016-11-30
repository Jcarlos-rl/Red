@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Nuevo Proyecto</h1>
            <div class="panel panel-default">
                <div class="panel-body">
                  {!! Form::open(['route'=> 'user.proyectos.store','method' => 'POST', 'files' => true]) !!}
                  <div class="form-group">
                    {!! Form::label('Nombre', 'Nombre') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre...']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('Descripcion', 'Descipcion') !!}
                    {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripcion...']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('Imagen','Imagen')!!}
                    <input type="file" class="form-control" name="imagenProyecto">                    
                  </div>
                  <br>
                    <br>
                    {!! Form::submit('Agregar', ['class' => 'btn btn-success', 'style' => 'width:100%']) !!}
                  </div>
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
