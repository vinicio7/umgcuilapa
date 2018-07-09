<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    protected $table = 'actividades';
   	protected $fillable = ['fecha_inicio','fecha_fin','titulo','descripcion','id_usuario','fecha_actividad']; 

   	public function usuario() {
        return $this->hasOne('App\Usuarios', 'id_usuario', 'id');
    }

}
