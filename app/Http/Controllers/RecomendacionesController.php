<?php

namespace App\Http\Controllers;

use App\Lugar;
use App\Recomendacion;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RecomendacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Lugar $lugar)
    {
        return $this->present($lugar->recomendaciones);
    }

    protected function present($recomendacion)
    {
        if ($recomendacion instanceof Collection) {
            return $recomendacion->map(function ($r) {
                return $this->present($r);
            });
        } else {
            return [
                'id' => $recomendacion->id,
                'me_gusta' => $recomendacion->me_gusta,
                'comentario' => $recomendacion->comentario,
                'persona' => [
                    'id' => $recomendacion->persona->id,
                    'nombre' => $recomendacion->persona->nombre,
                    'apellido' => $recomendacion->persona->apellido,
                    'nombre_para_mostrar' => $recomendacion->persona->nombre_para_mostrar,
                    'avatar' => $recomendacion->persona->avatar,
                ],
                'lugar' => [
                    'id' => $recomendacion->lugar->id,
                    'nombre' => $recomendacion->lugar->nombre,
                ],
            ];
        }
    }
}
