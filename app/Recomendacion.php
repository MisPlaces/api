<?php

namespace App;

use App\Lugar;
use App\Persona;
use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    protected $table = 'recomendacion';

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class);
    }
}
