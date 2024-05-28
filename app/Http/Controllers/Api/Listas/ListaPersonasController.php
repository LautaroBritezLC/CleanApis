<?php

namespace App\Http\Controllers\Api\Listas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ListaPersonasController extends Controller
{
    public function SP_ListaPersonas(Request $request) {
    // Ejecutar el procedimiento almacenado SP_ListaPersonas
    $resultados = DB::select('CALL SP_ListaPersonas()');

    // Devolver los resultados como respuesta
    return response()->json([
        'Message' => 'OK',
        'Status' => 200,
        'Personas' => $resultados,
    ], 200);
}
}
