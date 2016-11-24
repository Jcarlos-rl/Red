@extends('layouts.app')

@section('content')

<p>Titulo: {{$evento->nombre}}</p>
<p>Lugar: {{$evento->lugar}}</p>
<p>Inicio de Registro: {{$evento->inicioRegistro}}</p>
<p>Fin de Registro: {{$evento->fin_registro}}</p>
<p>Inicio de Evento: {{$evento->inicio_evento}}</p>
<p>Fin de Evento: {{$evento->fin_evento}}</p>
<p>Descripcion: {{$evento->descripcion}}</p>


@endsection