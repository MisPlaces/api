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
            return $lugar;
            return [
                'id' => $lugar->id,
            ];
        }
    }
}
