@extends('layouts.app')

@section('content')
 @if($proyectos->isEmpty())
    <div class="container">
        <h2>Proyectos</h2>
        <th>Este evento todavia no tiene proyectos</th>
    </div>
    @else
<div class="container">
    <h2>Proyectos</h2>
   
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                        <thread>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thread>
                        <tbody>
                            
                            @foreach($proyectos as $proyecto)
                                <tr class="rowsTabla" id="{{$proyecto->id}}">
                                    <th scope="row" id="projectName" class="text-center">{{$proyecto->nombre}}</th>
                                    <th class="text-center">
                                        <!-- Single button -->
                                    <!--<i class="fa fa-plus-circle fa-2x" value="{{$proyecto->id}}" id="{{$proyecto->id}}" onclick="redirect({{$proyecto->id}})"></i>-->
                                    <i class="fa fa-plus-circle fa-2x" aria-hidden="true" data-toggle="modal" data-target="#VerProyecto"></i>
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


<!-- modal Crear Proyecto-->
<div class="modal fade" id="VerProyecto" tabindex="-1" role="dialog" aria-labelledby="Ver Proyecto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{$proyecto->nombre}}</h4>
      </div>
      <div class="modal-body">
        {{$proyecto->descripcion}}
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-info" id="SolicitarColaboracion" data-toggle="modal" data-target="#solicitarModal">Solicitar Colaboracion</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="solicitarModal" tabindex="-1" role="dialog" aria-labelledby="Solicitar Colaboracion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">¿Estás seguro de enviar la solicitud?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="EnviarSolicitud">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" style="width:100%;">SI</button>
        </form>
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){

    /*Falya definir la funcion que hará al enviar la solicitud 
    $('#solicitarColaboracion').click(function(){
           $('#solicitarModal').modal('show');
           $('form#EnviarSolicitud').attr('action','');
         });

    });
    */
     function redirect(x){
        var url = "../proyecto/"+x;
        window.location.href = url;
    }


</script>
@endif
@endsection
