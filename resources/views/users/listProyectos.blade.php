@extends('layouts.app')

@section('content')

<h1>Proyectos</h1>
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
                                    <th scope="row">{{$proyecto->nombre}}</th>
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
                                            <a href="#" class="btn btn-danger btn-md">Eliminar</a>
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
