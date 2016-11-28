@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Nuevo Proyecto</h1>
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
<<<<<<< HEAD
                  <div class="form-group">
                  <br>
                    {!! Form::submit('Agregar', ['class' => 'btn btn-success', 'style' => 'width:100%']) !!}
=======
                    {!! Form::submit('Agregar', ['class' => 'btn btn-success']) !!}
>>>>>>> d8b0cb287b061487c20b3a9b3376c21ea2f4d850
                  </div>
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
