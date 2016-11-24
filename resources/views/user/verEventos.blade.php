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
  <div class="panel-group" id="accordion">
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
  </div>
  
</div>
<script>

    function redirect(x){
        var url = "evento/"+x;
        window.location.href = url;
    }
</script>







@endsection