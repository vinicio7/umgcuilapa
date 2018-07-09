<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
   	protected $fillable = ['nombre','telefono','correo','genero','usuario','password']; 
   	protected $hidden = ['password'];
}
