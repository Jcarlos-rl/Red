<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Mail</title>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,900italic,900,400italic,300italic,300,100italic,100,700,700italic" rel="stylesheet" type="text/css">
  <style type="text/css">
  .button a{background: #938676;
  			border-color: #fff;
  			color: #fff !important;
  			padding: 25px 120px;
      			width: 100%;
  			text-decoration:none;
  			font-size: 2em}

  .button a:hover{
  			background: #60594d;
  			border-color: inherit;
  			font-size: 2em}

  			a {color: #999;
  			text-decoration:none;}
  			a:hover {color: #e61a30;
  			text-decoration:none;}

  			@media (min-width: 200px) and (max-width: 375px) {

  .button a{background: #938676;
  			border-color: #fff;
  			color: #fff !important;
  			padding: 25px 120px;
      		width: 100%;
  			text-decoration:none;
  			font-size: 2em}

  .button a:hover{
  	background: #60594d;
  			border-color: inherit;
  			font-size: 2em}

  			a {color: #999;
  			text-decoration:none;}
  			a:hover {color: #e61a30;
  			text-decoration:none;}
    }
  </style>
</head>
  <body style="font-family: 'Roboto', sans-serif; color:#06a5a3; width: 100%; margin: 0;">
  	<div style=" width: 100%; margin: auto;">
  		<div id="logo" style="background:#06a5a3; padding:20px; text-align:center;">
  			<a style="color: #FFF; font-size: 50px;" href="{{ url('/') }}">Entorno Colaborativo</a>
  		</div>
  		<div style=" margin: auto; text-align: center; padding: 50px 0px 10px 0px;">
  			<p style="margin: 0px; color:#06a5a3; font-size: 20px; padding: 0 20px;">Invitación de participación en proyecto {{ $proyecto->nombre }}</p>
  			<p style="-webkit-margin-before: .3em; -webkit-margin-after: 1em; padding: 0 20px; color:#06a5a3;">Hola {{ $usuario->name }} el usuario {{ $local->name }} te ha invitado a formar parte de su proyecto:</p>
  			<div class="button" style="margin: auto; text-align:center; position: relative; padding: 15px 0px; text-align: center; border-radius: 5px; width: 75%; margin-top: 50px;">
  					<a style="color: #FFF; background-color: #06a5a3; text-decoration: none; font-size: 20px; border: #06a5a3 2px solid; padding: 15px 10%; width:100%;" href="{{ url('email/confirmacion', ['ACCEPTED', $usuario->id, $proyecto->id]) }}">Acpetar</a>
            <a style="color: #FFF; background-color: #06a5a3; text-decoration: none; font-size: 20px; border: #06a5a3 2px solid; padding: 15px 10%; width:100%;" href="{{ url('email/confirmacion', ['REJECTED', $usuario->id, $proyecto->id]) }}">Rechazar</a>
  			</div>
  		</div>
  		<div style="margin: auto; text-align: center; padding: 100px 90px 30px 90px; font-size:0.8em; color:#999;">
  			<p>
           La información transmitida está destinada únicamente a la persona o entidad a quien que va dirigida y puede contener información conﬁdencial y/o material privilegiado. <br/>
           Cualquier revisión, retransmisión, difusión u otros usos, o cualquier acción tomada por personas o entidades distintas al destinatario basándose en esta información está prohibida. <br/>
           Si usted recibe este mensaje por error, por favor contacte al remitente y elimine el material de cualquier computadora.
        </p>
  		</div>
  		<div style="background:#333; margin: auto; padding:30px 30px 30px 30px; text-decoration:none; text-align:center; color:#FFF; font-size:13px;">
  			<ul style="list-style:none">
      		<li> T. +(222) 372 3000 Exts. 15200 / 15204 / 19155</li>
      		<li>Blvd. del Niño Poblano No. 2901 Colonia Reserva Territorial Atlixcáyotl, San Andrés Cholula, Pue., 72810 </li>
      	</ul>
  		</div>
  		<div style="background:#000; padding:10px; text-align:center; color:#FFF; font-size:13px;">
  			<p>Copyright © 2015 por <a style="color: #ccc; text-decoration:none;"href="{{ url('/') }}" target="_blank">www.Entorno Colaborativo.mx</a></p>
  		</div>
  	</div>
  </body>
</html>
