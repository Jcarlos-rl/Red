@extends('layouts.app')

@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                        <thread>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Información</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thread>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <th>{{$user->name}}</th>
                                    <th><i class="fa fa-plus-circle fa-2x" aria-hidden="true" value="{{$user->id}}"></i></th>
                                    <th><i class="fa fa-pencil-square fa-2x" aria-hidden="true" value="{{$user->id}}"></i></th>
                                    <th><i class="fa fa-trash fa-2x" aria-hidden="true" value="{{$user->id}}"></i></th>
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



<!-- modal informacion user-->
<div class="modal fade" id="verUser" tabindex="-1" role="dialog" aria-labelledby="Ver User">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="informacionUser">
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- modal seguridad eliminar proyecto-->
<div class="modal fade" id="eliminarUser" tabindex="-1" role="dialog" aria-labelledby="Eliminar User">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">Estas seguro de eliminar el usuario ?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="eliminarUser">
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
           $('#verUser').modal('show'); 

            $.ajax({
                url : '/admin/user/'+$(this).attr('value')+'/getInformacion',
                type : 'GET',
                dataType : 'json',
                beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                     }
               },
                success:function(response){
                    $('div#informacionUser').html(
                        '<div class="col-sm-12">'+
                            '<div class="row">'+
                                '<div class="col-sm-8 col-sm-offset-2">'+
                                    '<h2 style="text-align:center;">'+response.name+'</h2>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-sm-12">'+
                                    '<p class="lead">'+response.email+'</p>'+
                                '</div>'+
                            '</div>'+
							'<div class="row">'+
                                '<div class="col-sm-12">'+
                                    '<p class="lead">'+response.roles+'</p>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                }
            });
        });

        $('i.fa-pencil-square').click(function(){
           window.location.href = '/admin/user/'+$(this).attr('value')+'/editar';
        });

         $('i.fa-trash').click(function(){
           $('#eliminarUser').modal('show');
           $('form#eliminarUser').attr('action','/admin/user/'+$(this).attr('value')+'/eliminar');
         });


    });

</script>

@endsection
