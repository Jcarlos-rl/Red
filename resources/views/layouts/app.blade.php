<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="logo.gif">
    <title>Entorno Colaborativo</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    @yield('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

     <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand">
                    Entorno Colaborativo
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
               @if (!Auth::guest())
                <!-- *********************************************************                              <<<<  OJO
                            Si el usuario no ha iniciado sesion
                ***********************************************************-->
                    @if (Auth::user()->roles == 'aa') 
                         <!-- *********************************************************                              <<<<  OJO
                                     Si el usuario es ADMIN
                         ***********************************************************-->
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/') }}">Inicio</a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/admin/eventos') }}">Eventos</a></li>
                        </ul>
						<ul class="nav navbar-nav">
                            <li><a href="{{ url('/admin/proyectos') }}">Proyectos</a></li>
                        </ul>
						<ul class="nav navbar-nav">
                            <li><a href="{{ url('/admin/users') }}">Usuarios</a></li>
                        </ul>
                    @elseif  (Auth::user()->roles == 'ae')                       
						<!-- *********************************************************                              <<<<  OJO
                                     Si el usuario es ADMIN EVENTOS
                         ***********************************************************-->
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/') }}">Inicio</a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/admin/eventos') }}">Eventos</a></li>
                        </ul>
					@elseif  (Auth::user()->roles == 'ap')                       
						<!-- *********************************************************                              <<<<  OJO
                                     Si el usuario es ADMIN PROYECTOS
                         ***********************************************************-->
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/') }}">Inicio</a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/admin/proyectos') }}">Proyectos</a></li>
                        </ul>
					@else
                         <!-- *********************************************************                              <<<<  OJO
                                     Si el usuario no es ADMIN 
                         ***********************************************************-->
                         
                        <ul class="nav navbar-nav">
                           <li><a href="{{ url('/user/eventos') }}">Eventos</a></li> 
                           <li><a href="{{ route('user.proyectos.index') }}">Proyectos</a></li>
                        </ul>
                    @endif
               @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li id="modalLink"><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope" aria-hidden="true"></i><span class="badge" id="nuevos_mensajes"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                @php
									switch(Auth::user()->roles)
									{
										case 'aa': 	echo '[Administrador]';
													break;
										case 'ap':	echo '[A-Proyectos]';
													break;
										case 'ae':	echo '[A-Eventos]';
													break;
										case 'us':	echo '[Usuario]';
													break;
									}
                                @endphp
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('/user/configuracion')}}"<i class="fa fa-cog" aria-hidden="true"></i>  Configuración Cuenta</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out" aria-hidden="true"></i>Cerrar Sesión</a></li>
                            </ul>
                           

                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @include('flash::message')
    @yield('content')
    @yield('javascripts')
    @yield('slideshow')
    @yield('about')
    @yield('footer')

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel" style="text-align:center;">Mensajes</h4>
        </div>
        <div class="modal-body">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="text-align:center;">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Bandeja E/S
                        </a>
                    </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12" style=" height:250px; overflow:scroll;">
                                    <table class="table table-hover">
                                            <thread>
                                                <tr>
                                                    <th>Remitente</th>
                                                    <th>Fecha Recibido</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thread>
                                            <tbody id="nuevos_mensajes">
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title" style="text-align:center;">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Mensajes Leidos
                        </a>
                    </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                      <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12" style=" height:250px; overflow:scroll;">
                                    <table class="table table-hover">
                                            <thread>
                                                <tr>
                                                    <th>Remitente</th>
                                                    <th>Fecha Recibido</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thread>
                                            <tbody id="bandeja_leidos">
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                 
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title" style="text-align:center;">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Mensajes Archivados (Importantes)
                        </a>
                    </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                    <h4 class="panel-title" style="text-align:center;">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Nuevo Mensaje
                        </a>
                    </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                    <div class="panel-body">
                       <div class="container-fluid">
                            <div class="row">
                               <div class="col-md-12">
                                    <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Destinatario" list="destinatarios_nm" id="destinatario_nm">
                                    <datalist id="destinatarios_nm"> 
                                    </datalist>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">Seleccionar</button>
                                    </span>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-md-12 -->
                                <div class="col-md-12"> <!-- Lista de destinatarios -->
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="3" id="cuerpo_nm"></textarea>
                                    <br>
                                    <button class="btn btn-success" style="width:100%;" id="enviar_nm">Enviar</button>
                                </div>
                            </div>
                       </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="width:100%;">Close</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Button trigger modal Ver Mensaje
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#verMensaje">
    Launch demo modal
    </button>
     -->
    <!-- Modal Ver Mensaje-->
    <div class="modal fade" id="verMensaje" tabindex="-1" role="dialog" aria-labelledby="verMensajeLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="verMensajeLabel" style="text-align:center;"></h4>
        </div>
        <div class="modal-body" id="cuerpo_msg">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="width:100%;">Close</button>
        </div>
        </div>
    </div>
    </div>


    <script>
        var nuevos_mensajes = function()
        {
            //span nuevos_mensajes 
            $.ajax({
                url:  '/user/bandejaEntrada/',
                type: 'POST',
                dataType: 'json',
                beforeSend: 
                function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                success:
                function(response){
                    //alert(JSON.stringify(response));
                    $('span#nuevos_mensajes').empty();
                    $('span#nuevos_mensajes').append(response.length);
                    $('tbody#nuevos_mensajes').empty();
                    for(var i=0; i<response.length; i++)
                    {
                        $('tbody#nuevos_mensajes').append(
                            '<tr value="'+response[i].id+'">'+
                                '<th>'+response[i].name+'</th>'+
                                '<th>'+response[i].fecha_envio+'</th>'+
                                '<th>'+response[i].status+'</th>'+
                            '</tr?'
                         );
                    }
                }    
            });
        }
        var bandeja_leidos = function()
        {
            //span nuevos_mensajes 
            $.ajax({
                url:  '/user/bandejaLeidos/',
                type: 'POST',
                dataType: 'json',
                beforeSend: 
                function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                success:
                function(response){
                    //alert(JSON.stringify(response));
                    $('tbody#bandeja_leidos').empty();
                    for(var i=0; i<response.length; i++)
                    {
                        $('tbody#bandeja_leidos').append(
                            '<tr value="'+response[i].id+'">'+
                                '<th>'+response[i].name+'</th>'+
                                '<th>'+response[i].fecha_envio+'</th>'+
                                '<th>'+response[i].status+'</th>'+
                            '</tr?'
                         );
                    }
                }    
            });
        }
        $(document).delegate('li#modalLink','click',function(){
            $.ajax({
                url:'/user/getListaDestinatarios',
                type:'POST',
                dataType:'json',
                beforeSend: 
                function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                success:
                function(response){
                    //alert(JSON.stringify(response));
                    for(var i=0; i<response.length; i++)
                    {
                         $('datalist#destinatarios_nm').append(
                            '<option value="'+response[i].name+'"></option>'
                          );
                    }
                }    
            });
        });
        $(document).delegate('tbody#nuevos_mensajes > tr', 'click', function(){
            //alert($(this).attr('value'));
            $.ajax({
                url:'/user/verMensaje',
                type:'POST',
                dataType:'json',
                data:{
                    'id_mensaje':$(this).attr('value')
                },
                beforeSend: 
                    function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                        var token = $('meta[name="csrf_token"]').attr('content');
                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                },
                success:
                function(response){
                     //alert(JSON.stringify(response));
                     $('#verMensaje').modal('show');
                     $('h4#verMensajeLabel').empty();
                     $('h4#verMensajeLabel').append(
                         response.name+" envia en fecha "+response.fecha_envio
                     );
                     $('div#cuerpo_msg').empty();
                     $('div#cuerpo_msg').append(response.cuerpo);


                }    
            });
        });
         $(document).delegate('tbody#bandeja_leidos > tr', 'click', function(){
            //alert($(this).attr('value'));
            $.ajax({
                url:'/user/verMensaje',
                type:'POST',
                dataType:'json',
                data:{
                    'id_mensaje':$(this).attr('value')
                },
                beforeSend: 
                    function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                        var token = $('meta[name="csrf_token"]').attr('content');
                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                },
                success:
                function(response){
                     //alert(JSON.stringify(response));
                     $('#verMensaje').modal('show');
                     $('h4#verMensajeLabel').empty();
                     $('h4#verMensajeLabel').append(
                         response.name+" envia en fecha "+response.fecha_envio
                     );
                     $('div#cuerpo_msg').empty();
                     $('div#cuerpo_msg').append(response.cuerpo);


                }    
            });
        });
        $(document).ready(function(){
             $('button#enviar_nm').click(function(){
               // alert($('input#destinatario_nm').val()+$('textarea#cuerpo_nm').val());
               $.ajax({
                   url:'/user/nuevoMensaje',
                   type:'POST',
                   dataType:'json',
                   data:{
                       'destinatario': $('input#destinatario_nm').val(),
                             'cuerpo': $('textarea#cuerpo_nm').val()
                   },
                    beforeSend: 
                    function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                        var token = $('meta[name="csrf_token"]').attr('content');
                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    success:
                    function(response){
                        alert(response);
                    }    
               });
            });
            setTimeout(nuevos_mensajes,200);//funcion ejecuta inmediatamente la funcion para saber mensajes llegada una sola vez
            setTimeout(bandeja_leidos,200);//funcion ejecuta inmediatamente la funcion para saber mensajes llegada una sola vez
            setInterval(nuevos_mensajes, 30000);//funcion con intervalo de 30000mS = 30S para saber mensajes llegada
            setInterval(bandeja_leidos, 30000);//funcion con intervalo de 30000mS = 30S para saber mensajes llegada
        });
    </script>

</body>
</html>
