@extends('layouts.app')

@section('content')

<h1>Nuevo Proyecto</h1>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                  {!! Form::open(['route'=> 'user.proyectos.store','method' => 'POST']) !!}
                  <div class="form-group">
                    {!! Form::label('Nombre', 'Nombre') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre...']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('Descripcion', 'Descipcion') !!}
                    {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripcion...']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::submit('Agregar', ['class' => 'btn btn-success']) !!}
                  </div>
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
