<?php

namespace App;

use App\Categoria;
use App\Recomendacion;
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

    public function recomendaciones()
    {
        return $this->hasMany(Recomendacion::class);
    }

    public function getMapAttribute()
    {
        $nombre = preg_replace('~ +~', '+', $this->nombre);
        return "https://www.google.com/maps/place/$nombre/@$this->latitud,$this->longitud,17z";
    }

    public function getImagenUrlAttribute()
    {
        return 'http://192.168.19.86/backend/web/uploads/images/lugar/'.$this->image_name;
    }
}
