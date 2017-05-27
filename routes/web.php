<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/lugares', 'LugaresController', ['only' => ['index', 'show']]);
Route::resource('/categorias', 'CategoriasController', ['only' => ['index', 'show']]);
Route::resource('/lugares/{lugar}/recomendaciones', 'RecomendacionesController', ['only' => ['index', 'show']]);
