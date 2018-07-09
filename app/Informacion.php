<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    protected $table = 'informacion';
   	protected $fillable = ['descripcion','mision','vision','id_usuario']; 

   	public function usuario() {
        return $this->hasOne('App\Usuarios', 'id_usuario', 'id');
    }
}
