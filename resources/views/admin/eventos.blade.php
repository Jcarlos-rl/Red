@extends('layouts.app')

@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-success" style="width:100%;" data-toggle="modal" data-target="#crearEvento">Crear Evento</button>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thread>
                            <tr>
                                <th>#</th>
                                <th>nombre</th>
                                <th>inicio_registro</th>
                                <th>fin_registro</th>
                                <th>inicio_evento</th>
                            </tr>
                        </thread>
                        <tbody>
                            @foreach($eventos as $evento)
                                <tr>
                                    <th scope="row">{{$evento->id}}</th>
                                    <th>{{$evento->nombre}}</th>
                                    <th>{{$evento->inicioRegistro}}</th>
                                    <th>{{$evento->fin_registro}}</th>
                                    <th>{{$evento->inicio_evento}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- modal Crear evento-->
<div class="modal fade" id="crearEvento" tabindex="-1" role="dialog" aria-labelledby="Crear Evento">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear Evento</h4>
      </div>
      <form action="/admin/eventos/crear" method="POST">
      {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
        <div class="modal-body">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" required><br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Close</button>
            <button type="submit" class="btn btn-primary" id="crearEvento">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
/*
    $(document).ready(function(){
       $.ajax({
           url : '/admin/eventos/id',
           type : 'POST',
           dataType : 'json',
           beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
           success:function(response){
                 //alert(response.length);
                 for(var i=0; i<response.length; i++){
                     $('tbody').append(
                         '<tr>'+
                            '<th scope="row">'+response[i].id+'</th>'+
                            '<th>'+response[i].nombre+'</th>'+
                            '<th>'+response[i].inicioRegistro+'</th>'+
                            '<th>'+response[i].fin_registro+'</th>'+
                            '<th>'+response[i].inicio_evento+'</th>'+
                         '</tr>'
                     );
                 }
                 
           }
       });
    });
*/
</script>

@endsection
