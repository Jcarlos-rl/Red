@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                  {!! Form::open(['route'=>[ 'user.proyectos.update',$proyecto],'method' => 'PUT']) !!}
                  <div class="form-group">
                  <h3> Titulo del Proyecto </h3>
                    {!! Form::text('nombre',$proyecto->nombre, ['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                  <h3> Descripcion </h3>
                    {!! Form::text('descripcion',$proyecto->descripcion, ['class' => 'form-control']) !!}
                  </div>
                  <h3>Imagen</h3>
                    <input type="file" class="form-control" name="imagen">
                  <br>
                  <div class="form-group">
                    {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
                  </div>
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
