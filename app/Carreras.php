<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    protected $table = 'carreras';
   	protected $fillable = ['nombre','imagen','plan','descripcion','ubicacion','duracion','horario','id_usuario','id_sede_extension']; 

   	public function usuario() {
        return $this->hasOne('App\Usuarios', 'id_usuario', 'id');
    }

	public function sede() {
        return $this->hasOne('App\Sedes', 'id_sede_extension', 'id');
    }
}
