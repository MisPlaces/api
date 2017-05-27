<?php

namespace App;

use App\Categoria;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    protected $table = 'lugar';
    protected $dates = [
        'fecha_creacion',
        'fecha_actualizacion',
    ];

    protected $casts = [
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getMapAttribute()
    {
        $nombre = preg_replace('~ +~', '+', $this->nombre);
        return "https://www.google.com/maps/place/$nombre/@$this->latitud,$this->longitud,17z";
    }
}
