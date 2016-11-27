<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function conocimientos()
    {
        return $this->belongsToMany('App\Conocimiento','users_conocimientos','user_id','conocimiento_id');
    }

    public function proyectos()
    {
        return $this->belongsToMany('App\Proyecto','users_proyectos','user_id','proyecto_id')->withPivot('rol')->withPivot('fecha_registro')->withPivot('status');
    }
}
