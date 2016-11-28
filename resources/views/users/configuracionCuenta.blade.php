@extends('layouts.app')

@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">Datos Personales</div>
                <div class="panel-body">
                   <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombreUsuario" value="{{$user->name}}">
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Foto Perfil</label>
                            <div class="col-sm-10">
                            <input type="file" class="form-control" name="imagen">
                            </div>
                        </div>
                        -->
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button id="guardarDatosPersonales" type="button" class="btn btn-primary form-control" >Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">Cambiar Contraseña</div>

                <div class="panel-body">
                   <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Actual</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" name="constraActualUsuario" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nueva</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" name="contraNuevaUsuario" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Repite</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" name="contraNuevaUsuarioOK" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button id="guardarCambios" type="button" class="btn btn-warning form-control" >Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <button id="guardarCambios" type="button" class="btn btn-danger form-control" >Eliminar Cuenta</button>
            </div>
        </div>
        <div class="col-md-6">
                <div class="panel panel-default">
                        <div class="panel-heading" style="text-align:center;">Conocimientos</div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="input-group">
                                            <input type="text" class="form-control" list="conocimientos" id="inputConocimiento">
                                                <datalist id="conocimientos"> 
                                                </datalist>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-success" id="agregarConocimiento">Agregar</button>
                                            </div><!-- /btn-group -->
                                        </div><!-- /input-group -->
                                    </div> 
                                    <div class="col-md-10 col-md-offset-1">
                                        <table class="table table-hover">
                                            <thread>
                                                <tr>
                                                    <th>Conocimiento</th>
                                                    <th></th>
                                                </tr>
                                            </thread>
                                            <tbody id="listaConocimientosUsuario">
                                                
                                            </tbody>
                                        </table>
                                    </div>                                  
                                </div>
                            </form>
                        </div>
                </div>
         </div>
    </div>
</div>

             <script>
                   var actualizaListaConocimientos = function(){
                       $.ajax({
                            url:'/getConocimientos',
                            type : 'POST',
                            dataType: 'json',
                            beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                                var token = $('meta[name="csrf_token"]').attr('content');
                                if (token) {
                                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                }
                            },
                            success:function(response)
                            {
                                //alert(JSON.stringify(response));
                                for(var i=0; i<response.length; i++)
                                {
                                    $('datalist#conocimientos').append(
                                        '<option value="'+response[i].nombre+'"></option>'
                                    );
                                }
                            }             
                        });
                   }
                   var actualizaMisConocimientos = function(){
                       $('tbody#listaConocimientosUsuario').empty();
                       $.ajax({
                           url:'/getMisConocimientos',
                           type:'POST',
                           dataType:'json',
                           beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                                var token = $('meta[name="csrf_token"]').attr('content');
                                if (token) {
                                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                }
                            },
                            success:function(response)
                            {
                                //alert(JSON.stringify(response));
                                for(var i=0; i<response.length; i++)
                                {
                                    $('tbody#listaConocimientosUsuario').append(
                                        '<tr>'+
                                            '<th>'+response[i].nombre+'</th>'+
                                            '<th><button class="btn-danger" id="eliminarMiConocimiento" value="'+response[i].conocimiento_id+'">X</button></th>'+
                                        '</tr?'
                                     );
                                }
                            }             
                       });
                   };
                $('tbody#listaConocimientosUsuario').delegate('#eliminarMiConocimiento','click',function(){
                    //alert($(this).attr('value'));
                    $.ajax({
                        url:'/eliminaConocimiento',
                        type: 'POST',
                        dataType: 'json',
                        data:{
                            'idConocimiento':$(this).attr('value')
                        },
                        beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                             var token = $('meta[name="csrf_token"]').attr('content');
                              if (token) {
                                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                              }
                        },
                        success:function(response)
                        {
                            alert(response);
                        }
                    });
                });
                $(document).ready(function(){
                   actualizaListaConocimientos();
                   actualizaMisConocimientos();
                   $(window).keydown(function(event){
                        if(event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                        }
                    });
                   $('button#guardarDatosPersonales').click(function(){
                        $.ajax({
                            url:'/user/actualizaDatosUsuario',
                            type: 'POST',
                            dataType: 'json',
                            data:{
                                'nombre' : $('input#nombreUsuario').val()
                            },
                            beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                                var token = $('meta[name="csrf_token"]').attr('content');

                                if (token) {
                                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                }
                            },
                            success:function(response)
                            {
                                alert(response);
                            }
                        });
                   });
                   $('button#agregarConocimiento').click(function(){
                       $.ajax({
                           url:'/actualizaConocimientos',
                           type:'POST',
                           dataType: 'json',
                           data:{
                               'conocimiento': $('input#inputConocimiento').val()
                           },
                           beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                                var token = $('meta[name="csrf_token"]').attr('content');

                                if (token) {
                                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                }
                            },
                            success:function(response)
                            {
                                $('datalist#conocimientos').empty();
                                actualizaMisConocimientos();
                               //alert(JSON.stringify(response));
                                for(var i=0; i<response.length; i++)
                                {
                                    $('datalist#conocimientos').append(
                                        '<option value="'+response[i].nombre+'"></option>'
                                    );
                                }
                            }
                       });
                   });
                });
            </script>

@endsection
