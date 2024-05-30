<?php

namespace App\Http\Controllers\Api\Parametria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TipoModuloController extends Controller
{
    public function SPL_TipoModulo(Request $request){
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'TipoLista' => 'required|integer|in:1,2', // 1 para activo, 2 para baja
        ]);

        // Si la validación falla, devolver la respuesta correspondiente
        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->errors(),
                'Status' => 400,
            ], 400);
        }
        $tipoLista = $request->input('TipoLista');
        // Ejecutar el procedimiento almacenado SPL_TipoPermiso
        $resultados = DB::select('CALL SPL_TipoModulo(?)', [$tipoLista]);

        // Verificar si el resultado está vacío
        if (empty($resultados)) {
            return response()->json([
                'Message' => 'Error al ejecutar el procedimiento almacenado',
                'Status' => 400,
            ], 400);
        }

        // Devolver los resultados como respuesta
        return response()->json([
            'Message' => 'OK',
            'Status' => 200,
            'TipoModulos' => $resultados,
        ], 200);
    }
}
