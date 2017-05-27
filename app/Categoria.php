<?php

namespace App;

use App\Lugar;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    public function lugares()
    {
        return $this->hasMany(Lugar::class);
    }

    public function getTipoAttribute()
    {
        return 'hotel';
    }
}
