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
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Proyectos</h1>
            <a href="{{route('user.proyectos.create')}}" class="btn btn-success" style="width:100%;">Crear Proyecto</a>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                        <thread>
                            <tr>
                                <th class="text-center col-md-3">Nombre</th>
                                <th class="text-center">Rol</th>
                                <th class="text-center">Acciones</th>
                                <th class="text-center">Evento</th>
                                <th></th>
                            </tr>
                        </thread>
                        <tbody>
                            @foreach($proyectos as $proyecto)
                                
                                <tr class="rowsTabla" id="{{$proyecto->id}}" onload="nombreEvento({{$proyecto->id}})">
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
                                            <a href="{{route('user.proyectos.edit',$proyecto->id)}}" class="btn btn-primary btn-md">Editar</a>
                                            <a href="#" class="btn btn-danger btn-md btn-delete">Eliminar</a>
                                          @else
                                            <a href="{{route('user.proyectos.show',$proyecto->id)}}" class="btn btn-success btn-md">Ver</a>
                                          @endif
                                        </div>
                                    </th>
                                    <th class="text-center">
                                        @if($proyecto->evento_id == NULL)
                                            <select id="eventos" style="width:75%;"></select>
                                            <th>
                                            <i class="fa fa-plus-circle fa-2x" aria-hidden="true" onclick="agregarProyecto({{$proyecto->id}})"></i></th>
                                        @else
                                            <input type="text" value="{{$proyecto->eventoNombre}}" style="width:75%;" readonly>
                                            <th><i class="fa fa-minus-circle fa-2x" aria-hidden="true" id="sacarProyecto" value="{{$proyecto->id}}"onclick="sacarProyecto({{$proyecto->id}})"></i></th>
                                        @endif
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

  <script>
    $(document).ready(function(){
        $.ajax({
           url:'/user/evento/agregarEvento',
           type : 'POST',
           dataType: 'json',
           beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
             var token = $('meta[name="csrf_token"]').attr('content');
             if (token) {
                   return xhr.setRequestHeader('X-CSRF-TOKEN', token);
             }
           },
           success:function(response){
              $('select#eventos').empty();
              $('select#eventos').append(
                      '<option value=NULL></option>'
                  );
              for(var i=0; i<response.length; i++){
                 $('select#eventos').append(
                      '<option value="'+response[i].id+'">'+response[i].nombre+'</option>'
                  );
              }
              
           }    
       });

    $('i#sacarProyecto').click(function(){
        $.ajax({
           url:'/user/evento/sacarProyecto',
           type : 'POST',
           dataType: 'json',
             data:{
               'id': $('i#sacarProyecto').attr('value')
             },
           
           beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
              var token = $('meta[name="csrf_token"]').attr('content');
              if (token) {
                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
              }
           },
           success: function(response){
                location.reload();
            }             
       });
    });   
    });
    var agregarProyecto=function(proyecto){
    $.ajax({
           url:'/user/evento/agregarProyecto',
           type : 'POST',
           dataType: 'json',
             data:{
               'id': proyecto,
               'evento': $( "select#eventos option:selected" ).val()
             },
           
           beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
              var token = $('meta[name="csrf_token"]').attr('content');
              if (token) {
                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
              }
           },
           success: function(response){
                location.reload();
            }             
       });
}

  </script>



@endsection
