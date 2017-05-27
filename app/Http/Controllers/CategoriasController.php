<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->present(Categoria::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return $this->present($categoria);
    }

    protected function present($categoria)
    {
        if ($categoria instanceof Collection) {
            return $categoria->map(function ($c) {
                return $this->present($c);
            });
        } else {
            return [
                'id' => $categoria->id,
                'nombre' => $categoria->nombre,
                'descripcion' => $categoria->descripcion,
                'icono' => $categoria->icono,
                'tipo' => $categoria->tipo,
            ];
        }
    }
}
