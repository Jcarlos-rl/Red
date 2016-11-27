@extends('layouts.app')

@section('content')


<!--<div class="container">
        <div class="col-md-10 col-md-offset-1">
           @foreach($eventos as $evento)
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#{{$evento->id}}">{{$evento->nombre}}</a>
                            </h4>
                        </div>
                        <div id="{{$evento->id}}" class="panel-collapse collapse in">
                            <div class="panel-body">{{$evento->descripcion}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                
        </div>
</div>-->

<div class="container">
  <h2>Eventos</h2>
  <!--<div class="panel-group" id="accordion">
    @foreach($eventos as $evento)
    <div class="panel panel-default">
       <div class="panel-heading">
          <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#{{$evento->id}}">{{$evento->nombre}}</a>
           </h4>
       </div>
       <div id="{{$evento->id}}" class="panel-collapse collapse in">
         <div class="panel-body">
            <div>
            {{$evento->descripcion}}</div>
            <button type="button" class="btn btn-info" onclick="redirect({{$evento->id}})">Ver Evento</button>
         </div>
        </div>
    </div>
    @endforeach 
   </div>
   {!! $eventos -> render() !!}
  </div>-->
   <div class="panel-body">
               <table class="table table-striped">
                        <thread>
                            <tr>
                                <th>#</th>
                                <th>nombre</th>
                                <th></th>
                                
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
<script>

    function redirect(x){
        var url = "evento/"+x;
        window.location.href = url;
    }
</script>


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