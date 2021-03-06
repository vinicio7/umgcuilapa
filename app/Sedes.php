<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sedes extends Model
{
    protected $table = 'sedes';
   	protected $fillable = ['nombre','direccion','telefono_1','telefono_2','correo','horario_atencion','imagen','latitud','longitud','id_usuario']; 

   	public function usuario() {
        return $this->hasOne('App\Usuarios', 'id_usuario', 'id');
    }
}
