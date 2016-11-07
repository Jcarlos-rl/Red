<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conocimiento extends Model
{
     protected $fillable = [
        'nombre', 'experiencia',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User','users_conocimientos','conocimiento_id','user_id');
    }
}
