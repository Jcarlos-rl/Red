@extends('layouts.app')

@section('content')
<div class="progress no-border hidden" id="delete-progress">
  <div class="progress-bar progress-bar-striped active" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
    <span class="sr-only">Cargando...</span>
  </div>
</div>
<div class="alert alert-success hidden" id="message">
    <div class="container">
      <span id="text-message"></span>
    </div>
</div>
<h1>Proyectos</h1>
<a href="{{route('user.proyectos.create')}}" class="btn btn-success">+</a>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                        <thread>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Rol</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thread>
                        <tbody>
                            @foreach($proyectos as $proyecto)
                                <tr class="rowsTabla" id="{{$proyecto->id}}">
                                    <th scope="row" id="projectName">{{$proyecto->nombre}}</th>
                                    <th class="text-center">
                                      @if($proyecto->pivot->rol == 'ROLE_LEADER')
                                        <span class="label label-success">Lider</span>
                                      @else
                                        <span class="label label-primary">Colaborador</span>
                                      @endif
                                    </th>
                                    <th class="text-center">
                                        <!-- Single button -->
                                        <div class="btn-group">
                                          @if($proyecto->pivot->rol == 'ROLE_LEADER')
                                            <a href="{{route('user.proyectos.show',$proyecto->id)}}" class="btn btn-success btn-md">Ver</a>
                                            <a href="#" class="btn btn-primary btn-md">Editar</a>
                                            <a href="#" class="btn btn-danger btn-md btn-delete">Eliminar</a>
                                          @else
                                            <a href="{{route('user.proyectos.show',$proyecto->id)}}" class="btn btn-success btn-md">Ver</a>
                                          @endif
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $proyectos->render() !!}
                    {!! Form::open(['route' => ['user.proyectos.destroy', 'ID_PROJECT'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
  <script src="{{ asset('js/bootbox.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/proyectos/delete.js') }}" charset="utf-8"></script>
@endsection
