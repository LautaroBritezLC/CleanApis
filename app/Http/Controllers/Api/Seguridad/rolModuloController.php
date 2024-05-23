<?php

namespace App\Http\Controllers\Api\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class rolModuloController extends Controller
{
    public function SPL_RolModulo(Request $request) {

            // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdTipoRol' => 'integer',
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

        // Obtener los datos del cuerpo de la solicitud
        $idTipoRol = $request->input('IdTipoRol');
        $tipoLista = $request->input('TipoLista');

        // Ejecutar el procedimiento almacenado SPL_RolModulo
        $resultado = DB::select('CALL SPL_RolModulo(?, ?)', [$idTipoRol, $tipoLista]);

        // Verificar si el resultado está vacío
        if (empty($resultado)) {
            return response()->json([
                'Message' => 'El idTipoRol proporcionado no existe o no tiene relacionado ningun modulo',
                'Status' => 400,
            ], 400);
        }

        // Devolver los resultados como respuesta
        return response()->json([
            'Message' => 'OK',
            'Status' => 200,
            'RolModulo' => $resultado,
        ], 200);

    }

    public function SPA_RolModulo(Request $request) {

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdTipoRol' => 'required|integer',
            'IdTipoModulo' => 'required|integer',
            'IdTipoPermiso' => 'required|integer',
            'Token' => 'required|string|max:500',
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
        $idTipoRol = $request->input('IdTipoRol');
        $idTipoModulo = $request->input('IdTipoModulo');
        $idTipoPermiso = $request->input('IdTipoPermiso');
        $token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPA_RolModulo
        $resultado = DB::select('CALL SPA_RolModulo(?, ?, ?, ?)', [$idTipoRol, $idTipoModulo, $idTipoPermiso, $token]);

        // Verificar si el resultado está vacío
        if (empty($resultado)) {
            return response()->json([
                'Message' => 'Error al ejecutar el procedimiento almacenado',
                'Status' => 400,
            ], 400);
        }

        // Obtener el mensaje del resultado
        $mensaje = $resultado[0]->Message;
        // Determinar el estado de la operación según el mensaje
        if ($mensaje === 'OK') {
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
            ], 200);
        } else {
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400, // Bad Request
            ], 400);
        }

    }

    public function SPB_RolModulo(Request $request) {

            // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdRolModulo' => 'required|integer',
            'Token' => 'required|string|max:500',
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
        $idRolModulo = $request->input('IdRolModulo');
        $token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPB_RolModulo
        $resultado = DB::select('CALL SPB_RolModulo(?, ?)', [$idRolModulo, $token]);

        // Verificar si el resultado está vacío
        if (empty($resultado)) {
            return response()->json([
                'Message' => 'Error al ejecutar el procedimiento almacenado',
                'Status' => 400,
            ], 400);
        }

        // Obtener el mensaje del resultado
        $mensaje = $resultado[0]->v_Message;

        // Determinar el estado de la operación según el mensaje
        if ($mensaje === 'OK') {
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
            ], 200);
        } else {
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400, // Bad Request
            ], 400);
        }
    }


    

    public function SPH_RolModulo(Request $request) {
    
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdRolModulo' => 'required|integer',
            'Token' => 'required|string|max:500',
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
        $idRolModulo = $request->input('IdRolModulo');
        $token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPH_RolModulo
        $resultado = DB::select('CALL SPH_RolModulo(?, ?)', [$idRolModulo, $token]);

        // Verificar si el resultado está vacío
        if (empty($resultado)) {
            return response()->json([
                'Message' => 'Error al ejecutar el procedimiento almacenado',
                'Status' => 400,
            ], 400);
        }

        // Obtener el mensaje del resultado
        $mensaje = $resultado[0]->v_Message;

        // Determinar el estado de la operación según el mensaje
        if ($mensaje === 'OK') {
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
            ], 200);
        } else {
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400, // Bad Request
            ], 400);
        }

    }




}
