<?php

namespace App\Http\Controllers\Api\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller

{
    public function SPL_Usuarios(Request $request) {
        // Ejecutar el procedimiento almacenado SPL_Usuarios
        $resultados = DB::select('CALL SPL_Usuarios()');

        // Devolver los resultados obtenidos
        return response()->json([
            'Message' => 'OK',
            'Status' => 200,
            'Usuarios' => $resultados,
        ], 200);

    }

    public function SPA_Usuarios(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdUsuarioCarga' => 'required|integer',
            'IdPersona' => 'required|integer',
            'NombreUsuario' => [
                'required',
                'string',
                'min:8',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/[0-9]/', $value)) {
                        $fail('El nombre de usuario debe contener al menos un número.');
                    }
                },
            ],
            'Clave' => [
                'required',
                'string',
                'min:8',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/[A-Z]/', $value)) {
                        $fail('La contraseña debe contener al menos una letra mayúscula.');
                    }
                    if (!preg_match('/[0-9]/', $value)) {
                        $fail('La contraseña debe contener al menos un número.');
                    }
                },
            ],
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
        $IdUsuarioCarga = $request->input('IdUsuarioCarga');
        $IdPersona = $request->input('IdPersona');
        $NombreUsuario = $request->input('NombreUsuario');
        $Clave = $request->input('Clave');

        // echo $idUsuarioCarga  . ' ' . $id_persona . ' ' . $nombreUsuario . ' ' . $clave;

        // Ejecutar el procedimiento almacenado SPA_Usuarios
        $resultados = DB::select('CALL SPA_Usuarios(?, ?, ?, ?)', [
            $IdUsuarioCarga, $IdPersona, $NombreUsuario, $Clave
        ]);

        // Obtener el mensaje del resultado
        $mensaje = $resultados[0]->v_Message;

        // Devolver la respuesta según el mensaje obtenido
        if ($mensaje === 'OK') {
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
            ], 200);
        } else {
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        }


    }

    public function SPM_Usuarios(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdUsuario' => 'required|integer',
            'NuevoUsuario' => [
                'nullable',
                'string',
                'min:8',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/[0-9]/', $value)) {
                        $fail('El nuevo nombre de usuario debe contener al menos un número.');
                    }
                },
            ],
            'NuevaClave' => [
                'nullable',
                'string',
                'min:8',
                function ($attribute, $value, $fail) {
                    if (!empty($value) && !preg_match('/[[:upper:]]/', $value)) {
                        $fail('La nueva contraseña debe contener al menos una letra mayúscula.');
                    }
                    if (!empty($value) && !preg_match('/[0-9]/', $value)) {
                        $fail('La nueva contraseña debe contener al menos un número.');
                    }
                },
            ],
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
        $IdUsuario = $request->input('IdUsuario');
        $NuevoUsuario = $request->input('NuevoUsuario');
        $NuevaClave = $request->input('NuevaClave');


        // Ejecutar el procedimiento almacenado SPM_Usuario
        $resultados = DB::select('CALL SPM_Usuario(?, ?, ?)', [
            $IdUsuario, $NuevoUsuario, $NuevaClave
        ]);

        // Obtener el mensaje del resultado
        $mensaje = $resultados[0]->v_Message;

        // Devolver la respuesta según el mensaje obtenido
        if ($mensaje === 'OK') {
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
            ], 200);
        } else {
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        }

    }

    public function SPB_Usuarios(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdUsuario' => 'required|integer',
        ]);

        // Si la validación falla, devolver la respuesta correspondiente
        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->errors(),
                'Status' => 400,
            ], 400);
        }

        // Obtener el id_usuario del cuerpo de la solicitud
        $id_usuario = $request->input('IdUsuario');

        // echo $id_usuario;

        // Ejecutar el procedimiento almacenado SPB_Usuarios
        $resultados = DB::select('CALL SPB_Usuarios(?)', [$id_usuario]);

        // Obtener el mensaje del resultado
        $mensaje = $resultados[0]->v_Message;

        // Devolver la respuesta según el mensaje obtenido
        if ($mensaje === 'Usuario dado de baja correctamente.') {
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
            ], 200);
        } else {
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        }

    }


}
