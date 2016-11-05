<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'lugar', 'inicio_registro', 'fin_registro', 'inicio_evento', 'fin_evento', 'categoria'
    ];

    public function categorias()
    {
        return $this->belongsToMany('App\Categoria','eventos_categorias','evento_id','categoria_id');
    }
    
}
