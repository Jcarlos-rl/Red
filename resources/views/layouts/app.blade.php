<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
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
                            <li><a href="{{ url('/admin') }}">Inicio</a></li>
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
                            <li><a href="{{ url('/admin') }}">Inicio</a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/admin/eventos') }}">Eventos</a></li>
                        </ul>
					@elseif  (Auth::user()->roles == 'ap')                       
						<!-- *********************************************************                              <<<<  OJO
                                     Si el usuario es ADMIN PROYECTOS
                         ***********************************************************-->
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/admin') }}">Inicio</a></li>
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
                        </ul>
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
</body>
</html>
