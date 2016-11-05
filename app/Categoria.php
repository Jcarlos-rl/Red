<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre', 
    ];

    public function eventos()
    {
        return $this->belongsToMany('App\Evento','eventos_categorias','categoria_id','evento_id');
    }
}
