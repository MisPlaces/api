<?php

namespace App\Http\Controllers;

use App\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LugaresController extends Controller
{
    protected $lugares = [
        [
            'titulo' => 'Aeropuerto Internacional de Puerto Iguazú, Puerto Iguazú',
            'tipo' => 'Aeropuerto',
        ],
        [
            'titulo' => 'Cataratas del Iguazú, Puerto Iguazú',
            'tipo' => 'Atractivo',
        ],
        [
            'titulo' => 'Centro de Puerto Iguazú, Puerto Iguazú',
            'tipo' => 'Ciudad',
        ],
        [
            'titulo' => 'Nuevo Hotel Misiones, Puerto Iguazú',
            'tipo' => 'Hotel',
        ],
        [
            'titulo' => 'Puerto Esperanza',
            'tipo' => 'Ciudad',
        ],
        [
            'titulo' => 'Puerto Iguazú',
            'tipo' => 'Ciudad',
        ],
        [
            'titulo' => 'Puerto Libertad',
            'tipo' => 'Ciudad',
        ],
        [
            'titulo' => 'Puerto Rico',
            'tipo' => 'Ciudad',
        ],
        [
            'titulo' => 'Puerto, Puerto Iguazú',
            'tipo' => 'Puerto',
        ],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->present(Lugar::where('activo', 1)->get());
    }

    public function hoteles()
    {
        return $this->present(Lugar::where('activo', 1)->where('categoria_id', 1)->get());
    }

    public function posadas()
    {
        return $this->present(Lugar::where('activo', 1)->where('categoria_id', 8)->get());
    }

    public function restaurantes()
    {
        return $this->present(Lugar::where('activo', 1)->where('categoria_id', 5)->get());
    }

    public function buscar($termino)
    {
        $termino = preg_replace('~(\+|\%20)~', ' ', $termino);

        return collect($this->lugares)->filter(function ($lugar) use ($termino) {

            $patterns[0] = '/á/';
            $patterns[1] = '/é/';
            $patterns[2] = '/í/';
            $patterns[3] = '/ó/';
            $patterns[4] = '/ú/';
            $replacements[0] = 'a';
            $replacements[1] = 'e';
            $replacements[2] = 'i';
            $replacements[3] = 'o';
            $replacements[4] = 'u';
            
            $termino = preg_replace($patterns, $replacements, $termino);
            $titulo = preg_replace($patterns, $replacements, $lugar['titulo']);

            // dd($termino, $titulo);

            $termino = preg_replace('#\s+#', ' ', $termino);

            $titulo = strtolower($titulo);

            return 0 < preg_match('~'.$termino.'~i', $titulo);
        })->map(function ($lugar) use ($termino) {
            $patterns[0] = '/á/';
            $patterns[1] = '/é/';
            $patterns[2] = '/í/';
            $patterns[3] = '/ó/';
            $patterns[4] = '/ú/';
            $replacements[0] = 'a';
            $replacements[1] = 'e';
            $replacements[2] = 'i';
            $replacements[3] = 'o';
            $replacements[4] = 'u';
            
            $termino = preg_replace($patterns, $replacements, $termino);
            $titulo = preg_replace($patterns, $replacements, strtolower($lugar['titulo']));

            $termino = preg_replace('#\s+#', ' ', $termino);

            preg_match_all('~'.$termino.'~i', $titulo, $matches, PREG_OFFSET_CAPTURE);

            $highlight = $lugar['titulo'];
            $n = 0;
            foreach ($matches[0] as $item) {
                $item[1] += $n;
                $highlight = mb_substr($highlight, 0, $item[1]).'<b>'.mb_substr($highlight, $item[1]);
                $highlight = mb_substr($highlight, 0, $item[1] + mb_strlen($item[0]) + 3).'</b>'.mb_substr($highlight, $item[1] + mb_strlen($item[0]) + 3);
                $n += 7;
            }

            $lugar['highlight'] = $highlight;

            return $lugar;
        });
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
