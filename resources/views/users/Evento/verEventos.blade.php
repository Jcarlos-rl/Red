@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h2>Eventos</h2>
      <div class="panel panel-default">
        <table class="table table-striped">
          <thread>
            <tr>
              <th class="head"><h5>Id</h5></th>
              <th class="head"><h5>Nombre</h5></th>
              <th class="head"></th> 
            </tr>
          </thread>
          <tbody>
            @foreach($eventos as $evento)
            <tr class="rowsTabla">
              <th scope="row">{{$evento->id}}</th>
              <th >{{$evento->nombre}}</th>
              <th class="text-right"><i class="fa fa-plus-circle fa-2x" aria-hidden="true" value="{{$evento->id}}" onclick="redirect({{$evento->id}})"></i></th>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $eventos -> render() !!}
      </div>
    </div>
  </div>
</div>
<script>

    function redirect(x){
        var url = "evento/"+x;
        window.location.href = url;
    }
</script>


<style>
    .head{
      background-color: #5cb85c;
      color: white; 
    }
    i.fa-plus-circle{
      color: green;
    }
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


<!-- modal informacion evento-->
<div class="modal fade" id="verEvento" tabindex="-1" role="dialog" aria-labelledby="Ver Evento">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="informacionEvento">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

</script>







@endsection