<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
 	protected $table = 'preguntas';
   	protected $fillable = ['nombre','descripcion','id_usuario']; 

   	public function usuario() {
        return $this->hasOne('App\Usuarios', 'id_usuario', 'id');
    }
}
