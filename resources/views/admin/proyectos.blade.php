@extends('layouts.app')

@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-success" style="width:100%;" data-toggle="modal" data-target="#crearProyecto">Crear Proyecto</button>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thread>
                            <tr>
                                <th>#</th>
                                <th>nombre</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thread>
                        <tbody>
                            @foreach($proyectos as $proyecto)
                                <tr>
                                    <th scope="row">{{$proyecto->id}}</th>
                                    <th>{{$proyecto->nombre}}</th>
                                    <th><i class="fa fa-plus-circle fa-2x" aria-hidden="true" value="{{$proyecto->id}}"></i></th>
                                    <th><i class="fa fa-pencil-square fa-2x" aria-hidden="true" value="{{$proyecto->id}}"></i></th>
                                    <th><i class="fa fa-trash fa-2x" aria-hidden="true" value="{{$proyecto->id}}"></i></th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    i.fa-plus-circle:hover{
        color:blue;
    }
    i.fa-pencil-square:hover{
        color:green;
    }
    i.fa-trash:hover{
        color:red;
    }
</style>

<!-- modal Crear proyecto-->
<div class="modal fade" id="crearProyecto" tabindex="-1" role="dialog" aria-labelledby="Crear Proyecto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear Proyecto</h4>
      </div>
      <form action="/admin/proyectos/crear" method="POST">
      {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
        <div class="modal-body">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" required><br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="crearProyecto">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal informacion proyecto-->
<div class="modal fade" id="verProyecto" tabindex="-1" role="dialog" aria-labelledby="Ver Proyecto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="informacionProyecto">
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- modal seguridad eliminar proyecto-->
<div class="modal fade" id="eliminarProyecto" tabindex="-1" role="dialog" aria-labelledby="Eliminar Proyecto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">Estas seguro de eliminar el proyecto ?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="eliminarProyecto">
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

        $('i.fa-plus-circle').click(function(){
           $('#verProyecto').modal('show'); 

            $.ajax({
                url : '/admin/proyecto/'+$(this).attr('value')+'/getInformacion',
                type : 'GET',
                dataType : 'json',
                beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                     }
               },
                success:function(response){
                    $('div#informacionProyecto').html(
                        '<div class="col-sm-12">'+
                            '<div class="row">'+
                                '<div class="col-sm-8 col-sm-offset-2">'+
                                    '<h2 style="text-align:center;">'+response.nombre+'</h2>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-sm-12">'+
                                    '<p class="lead">'+response.descripcion+'</p>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                }
            });
        });

        $('i.fa-pencil-square').click(function(){
           window.location.href = '/admin/proyecto/'+$(this).attr('value')+'/editar';
        });

         $('i.fa-trash').click(function(){
           $('#eliminarProyecto').modal('show');
           $('form#eliminarProyecto').attr('action','/admin/proyecto/'+$(this).attr('value')+'/eliminar');
         });


    });

</script>

@endsection
