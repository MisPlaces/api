<?php

namespace App\Http\Controllers;

use App\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LugaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->present(Lugar::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function show(Lugar $lugar)
    {
        return $this->present($lugar);
    }

    protected function present($lugar)
    {
        if ($lugar instanceof Collection) {
            return $lugar->map(function ($l) {
                return $this->present($l);
            });
        } else {
            return [
                'id' => $lugar->id,
                'nombre' => $lugar->nombre,
                'categoria' => [
                    'id' => $lugar->categoria->id,
                    'nombre' => $lugar->categoria->nombre,
                ],
                'resumen' => $lugar->resumen,
                'cuerpo' => $lugar->cuerpo,
                'tipo' => $lugar->tipo,
                'direccion' => $lugar->direccion,
                'latitud' => $lugar->latitud,
                'longitud' => $lugar->longitud,
                'map' => $lugar->map,
                'telefono' => $lugar->telefono,
                'celular' => $lugar->celular,
                'email' => $lugar->email,
                'facebook' => $lugar->facebook,
                'twitter' => $lugar->twitter,
                'instagram' => $lugar->instagram,
                'youtube' => $lugar->youtube,
                'fechaEventoInicio' => $lugar->fechaEventoInicio,
                'fechaEventoFin' => $lugar->fechaEventoFin,
                'fechaVisibleDesde' => $lugar->fechaVisibleDesde,
                'fechaVisibleHasta' => $lugar->fechaVisibleHasta,
                'activo' => $lugar->activo,
                'fecha_creacion' => $lugar->fecha_creacion->toAtomString(),
                'fecha_actualizacion' => $lugar->fecha_actualizacion->toAtomString(),
            ];
        }
    }
}
