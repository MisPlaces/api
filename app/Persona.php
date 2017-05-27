<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';

    public function getNombreParaMostrarAttribute()
    {
        return $this->nombre.' '.$this->apellido;
    }

    public function getAvatarAttribute()
    {
        if (strtolower($this->sexo) == 'm') {
            return 'http://192.168.19.86/backend/web/uploads/images/male.jpg';
        } else {
            return 'http://192.168.19.86/backend/web/uploads/images/female.jpg';
        }
    }
}
