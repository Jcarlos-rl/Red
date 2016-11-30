@extends('layouts.app')

@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$user->name}}
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="nameUser" value="{{$user->name}}">
                            </div>
                        </div>                      
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Correo</label>
                            <div class="col-sm-10">
								<input type="text" class="form-control" id="emailUser" value="{{$user->email}}">
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-2 control-label">Rol</label>
                            <div class="col-sm-10">
								<input type="text" class="form-control" id="rolesUser" value="{{$user->roles}}">
                            </div>
                        </div>
						
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button id="guardarCambios" type="button" class="btn btn-success form-control" >Guardar Cambios</button>
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
                url : '/admin/user/{{$user->id}}/guardarCambios',
                type: 'POST',
                dataType : 'text',
                data:{
                    'name' : $('input#nameUser').val(),
					'email' : $('input#emailUser').val(),
					'roles' : $('input#rolesUser').val()
                },
                beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                success:function(response){
                    alert(response);
                     window.location.href = '/admin/users';
                }
            });
        });
    });
</script>

@endsection
