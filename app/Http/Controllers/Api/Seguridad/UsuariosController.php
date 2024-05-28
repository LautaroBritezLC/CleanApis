<?php

namespace App\Http\Controllers\Api\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller

{
    public function SPL_Usuarios(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'TipoLista' => 'required|integer',
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
        $tipoLista = $request->input('TipoLista');
    
        // Ejecutar el procedimiento almacenado SPL_Usuarios
        $resultados = DB::select('CALL SPL_Usuarios(?)', [$tipoLista]);
        
        // Obtener el mensaje del resultado
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;
    
        // Verificar si el mensaje es nulo (para el caso de que el tipo de lista sea válido)
        if ($mensaje === null) {
            // Devolver los resultados como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'Usuarios' => $resultados,
            ], 200);
        } else {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        }
    }
    

    public function SPA_Usuarios(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdUsuarioCarga' => 'required|integer',
            'IdPersona' => 'required|integer',
            'Usuario' => [
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
        $Usuario = $request->input('Usuario');
        $Clave = $request->input('Clave');

        // echo $idUsuarioCarga  . ' ' . $id_persona . ' ' . $nombreUsuario . ' ' . $clave;

        // Ejecutar el procedimiento almacenado SPA_Usuarios
        $resultados = DB::select('CALL SPA_Usuarios(?, ?, ?, ?)', [
            $IdUsuarioCarga, $IdPersona, $Usuario, $Clave
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
        DB::statement('CALL SPB_Usuarios(?)', [$id_usuario]);

        // Ejecutar el procedimiento almacenado SPB_Usuarios
        $resultados = DB::select('CALL SPB_Usuarios(?)', [$id_usuario]);

        // Verificar si la fila fue actualizada
        $usuario = DB::table('Usuario')->where('IdUsuario', $id_usuario)->first();

        // Devolver la respuesta según el resultado obtenido
        if ($usuario && $usuario->FechaBaja !== null) {
            return response()->json([
                'Message' => 'Usuario dado de baja correctamente.',
                'Status' => 200,
            ], 200);
        } else {
            return response()->json([
                'Message' => 'No se pudo dar de baja al usuario o el usuario no existe.',
                'Status' => 400,
            ], 400);
        }

    }


}
