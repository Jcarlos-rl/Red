<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class evento extends Model
{
     protected $fillable = [
      'nombre','organizador','fecha','lugar','tipo','ciudad','horario'  
    ];

    
    public function proyecto(){
       return $this->hasMany(App\proyecto);
    }    
}

