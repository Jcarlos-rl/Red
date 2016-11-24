@extends('layouts.app')

@section('content')

Eventos usuarios... <br><br>



A quien le toque esta parte del sistema diseñar la vista de los eventos ... <br><br><br>
NOTA: Para poder visualizar los eventos listados en esta pagina deben modificar el atributo STATUS en la tabla eventos a 1 ... <br>en el panel de ADMIN se implemento la funcionalida de activar o desactivar los eventos, si el evento esta desactivado no se mostrara<br><br><br>
<br><br>

Si estan en STATUS =  1 .... se muestran debajo de esta linea<br>
@foreach($eventos as $evento)

    {{$evento->id}} {{$evento->nombre}} <br>

@endforeach

@endsection
