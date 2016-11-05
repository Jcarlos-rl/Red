@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-success" style="width:100%;" data-toggle="modal" data-target="#crearEvento">Crear Evento</button>
                </div>
                <div class="panel-body">
                        Eventos
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
    $(document).ready(function(){
       
    });
</script>

@endsection
