<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'lugar', 'inicio_registro', 'fin_registro', 'inicio_evento', 'fin_evento', 'categoria'
    ];
}
