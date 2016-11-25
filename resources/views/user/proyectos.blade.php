@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-success" style="width:100%;" data-toggle="modal" data-target="#crearProyecto">Crear Proyecto</button>
                </div>
                <div class="panel-body">
                        Proyectos
                        <div class="panel-group" id="accordion">
    @foreach($proyectos as $proyecto)
    <div class="panel panel-default">
       <div class="panel-heading">
          <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#{{$proyecto->id}}">{{$proyecto->nombre}}</a>
           </h4>
       </div>
       <div id="{{$proyecto->id}}" class="panel-collapse collapse in">
         <div class="panel-body">
            <div>
            {{$proyecto->descripcion}}</div>
            <button type="button" class="btn btn-info" onclick="redirect({{$proyecto->id}})">Ver Proyecto</button>
         </div>
        </div>
    </div>
    @endforeach 
   </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- modal Crear Proyecto-->
<div class="modal fade" id="crearProyecto" tabindex="-1" role="dialog" aria-labelledby="Crear Proyecto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear Proyecto</h4>
      </div>
      <form action="/user/proyectos/crear" method="POST">
      {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
        <div class="modal-body">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" required><br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Close</button>
            <button type="submit" class="btn btn-primary" id="crearProyecto">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
       
    });
     function redirect(x){
        var url = "proyecto/ver/"+x;
        window.location.href = url;
    }
</script>

@endsection
