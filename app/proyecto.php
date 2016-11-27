<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    public $timestamps = false;

     protected $fillable = [
        'nombre', 'descripcion', 'status',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User','users_proyectos','proyecto_id','user_id')->withPivot('rol')->withPivot('fecha_registro')->withPivot('status');
    }
}