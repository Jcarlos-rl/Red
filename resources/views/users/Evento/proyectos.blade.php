@extends('layouts.app')

@section('content')
 @if($proyectos->isEmpty())
    <div class="container">
        <h2>Proyectos</h2>
        <th>Este evento todavia no tiene proyectos</th>
    </div>
    @else
<div class="container">
    
   
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h2>Proyectos</h2>
         <button class="btn btn-success" style="width:100%;" id="agregarProyect" data-toggle="modal" data-target="#agregarProyecto">Agregar Proyecto</button>
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
             <button type="submit" class="btn btn-danger" style="width:100%;" id="SolicitudEnviada">SI</button>
        
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="agregarProyecto" tabindex="-1" role="dialog" aria-labelledby="Agregar Proyecto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="/user/evento/agregarProyecto" method="post">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">Mis Proyectos</p>
      </div>
      <div class="modal-body">
            <select id="projects" style="width:100%;">
                
            </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success"  data-dismiss="modal" id="saveProject">Agregar Proyecto</button>
        <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
        $('button#SolicitudEnviada').click(function(){

            alert("Solicitud Enviada Correctamente");
        });  
        $('button#agregarProyect').click(function(){
            agregarProyecto();
       });
       $('button#saveProject').click(function(){
            saveProject();
       });

       var agregarProyecto= function(){
                       $.ajax({
                            url:'/user/proyectos-usuario',
                            type : 'POST',
                            dataType: 'json',
                            beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                                var token = $('meta[name="csrf_token"]').attr('content');
                                if (token) {
                                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                }
                            },
                            success:function(response){
                                $('select#projects').empty();
                                for(var i=0; i<response.length; i++){
                                    $('select#projects').append(
                                        '<option value="'+response[i].nombre+'">'+response[i].nombre+'</option>'
                                    );
                                }
                            }             
                        });
                   }
    

    });

    var saveProject= function(){
        $.ajax({
           url:'/user/evento/agregarProyecto',
           type : 'POST',
           dataType: 'json',
             data:{
               'nombre': $('option').val()
             },
           
           beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
              var token = $('meta[name="csrf_token"]').attr('content');
              if (token) {
                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
              }
           },
           success: function(response){
                alert(response);
                location.reload();
            }             
       });
   }
    
     function redirect(x){
        var url = "../proyecto/"+x;
        window.location.href = url;
    }
    
    


</script>
@endif
@endsection
