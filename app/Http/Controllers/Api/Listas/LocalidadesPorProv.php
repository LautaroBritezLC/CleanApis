<?php

namespace App\Http\Controllers\Api\Listas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LocalidadesPorProv extends Controller
{
    public function SPL_LocalidadPorProvincia(Request $request) {

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdProvincia' => 'required|integer',
        ]);

        // Si la validación falla, devolver la respuesta correspondiente
        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->errors(),
                'Status' => 400,
            ], 400);
        }

        // Obtener los datos del cuerpo de la solicitud
        $IdProvincia = $request->input('IdProvincia');
        // Ejecutar el procedimiento almacenado SPL_Personal
        $resultados = DB::select('CALL SPL_LocalidadPorProvincia(?)', [$IdProvincia]);

        // Devolver los resultados en formato JSON
        return response()->json([
            'Message' => 'OK',
            'Status' => 200,
            'Localidades' => $resultados,
        ], 200);
    }
}