@extends('layouts.app')

@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$proyecto->nombre}}
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombreProyecto" value="{{$proyecto->nombre}}">
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="col-sm-2 control-label">Descripcion</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="descripcionProyecto" rows="10">{{$proyecto->descripcion}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Evento</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="Evento" value="{{$proyecto->evento_id}}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button id="guardarCambios" type="button" class="btn btn-primary form-control" >Guardar Cambios</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button id="eliminarProyecto" class="btn btn-danger form-control" >Eliminar Proyecto</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
       $('button#guardarCambios').click(function(){
            $.ajax({
                url : '/user/proyecto/{{$proyecto->id}}/guardarCambios',
                type: 'POST',
                dataType : 'text',
                data:{
                    'nombre' : $('input#nombreProyecto').val(),
                    'descripcion'    : $('input#descripcionProyecto').val(),
                    'evento_id': $('input#Evento').val();
                },
                beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                success:function(response){
                    alert(response);
                }
            });
        });
    });
</script>

@endsection