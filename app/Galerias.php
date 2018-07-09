<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galerias extends Model
{
    protected $table = 'galeria';
   	protected $fillable = ['imagenes','descripcion','id_usuario','id_actividad']; 

   	public function usuario() {
        return $this->hasOne('App\Usuarios', 'id_usuario', 'id');
    }

    public function actividad() {
        return $this->hasOne('App\Actividades', 'id_actividad', 'id');
    }
}
