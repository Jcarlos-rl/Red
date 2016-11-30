@extends('layouts.app')

@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Proyectos</h2>
            <div class="panel panel-default">
                <table class="table table-striped">
                    <thread>
                        <tr>
                            <th class="head"><h5>Id</h5></th>
                            <th class="head"><h5>Nombre</h5></th>
                            <th class="head"></th>
                            <th class="head text-center"><h5>Status</h5></th>                              
                        </tr>
                    </thread>
                    <tbody>
                        @foreach($proyectos as $proyecto)
                        <tr class="rowsTabla">
                            <th scope="row">{{$proyecto->id}}</th>
                            <th>{{$proyecto->nombre}}</th>
                                <th><i class="fa fa-plus-circle fa-2x" aria-hidden="true" value="{{$proyecto->id}}"></i></th>                                    
								<th class="text-center">
                                <!-- Single button -->
                                <div class="btn-group">
                                    <button type="button" class="btn statusBtn" id="{{$proyecto->id}}" value="{{$proyecto->status}}">
                                        <i class="fa fa-bullseye" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    i.fa-plus-circle{
      color: green;
    }
    i.fa-plus-circle:hover{
        color:blue;
    }
    .head{
      background-color: #5cb85c;
      color: white; 
    } 
</style>

<!-- modal informacion proyecto-->
<div class="modal fade" id="verProyecto" tabindex="-1" role="dialog" aria-labelledby="Ver Proyecto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="informacionProyecto">
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" style="width:100%;" data-dismiss="modal"><h4>Cerrar</h4></button>
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
							'<div class="row">'+
                                '<div class="col-sm-12">'+
                                    '<p class="lead">'+response.evento+'</p>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                }
            });
        });

        $('.rowsTabla > th > div > button').each(function(){
             if($(this).attr('value') == 'WAITING')
			 {
                 $(this).addClass("btn-warning");
             }
			 else if($(this).attr('value') == 'REJECTED')
			 {
                 $(this).addClass("btn-danger");
             }
             else{
                 $(this).addClass("btn-success");
             }
         });
		 
		 $('.rowsTabla > th > div > button').click(function(){
             if($(this).attr('value') == 'WAITING')
             {
                 $(this).removeClass('btn-warning');
                 $(this).addClass('btn-success');
                 $(this).attr('value','ACCEPTED');
             }
			 else if($(this).attr('value') == 'ACCEPTED')
             {
                 $(this).removeClass('btn-success');
                 $(this).addClass('btn-danger');
                 $(this).attr('value','REJECTED');
             }
             else
			 {
                 $(this).removeClass('btn-danger');
                 $(this).addClass('btn-warning');
                 $(this).attr('value','WAITING');
             }
             $.ajax({
                 url:'/admin/proyecto/'+$(this).attr('id')+'/cambiarStatusProyecto',
                 type:'POST',
                 dataType:'json',
                 data:{
                     'status': $(this).attr('value')
                 },beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                 success:function(response){
                     //alert(response);
                 }
             });
         });


    });

</script>

@endsection
