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
    public function show(Lugar $lugare)
    {
        return $this->present($lugare);
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
                    'id' => $lugar->categoria?$lugar->categoria->id:null,
                    'nombre' => $lugar->categoria?$lugar->categoria->nombre:null,
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
                'imagen_url' => $lugar->imagen_url,
                'cuenta_recomendaciones' => $lugar->cuenta_recomendaciones,
                'cuenta_me_gusta' => $lugar->cuenta_me_gusta,
            ];
        }
    }
}
