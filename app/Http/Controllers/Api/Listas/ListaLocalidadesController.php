<?php

namespace App\Http\Controllers\Api\Listas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class ListaLocalidadesController extends Controller
{
    public function SPL_Localidad() {

    // Ejecutar el procedimiento almacenado SP_ListaPersonas
    $resultados = DB::select('CALL SPL_Localidad()');

    // Devolver los resultados como respuesta
    return response()->json([
        'Message' => 'OK',
        'Status' => 200,
        'Localidades' => $resultados,
    ], 200);
}
}
