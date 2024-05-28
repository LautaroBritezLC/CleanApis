<?php

namespace App\Http\Controllers\Api\Recursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    public function SPL_Personal(Request $request) {

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
        
        // Ejecutar el procedimiento almacenado SPL_Personal
        $resultados = DB::select('CALL SPL_Personal(?)', [$tipoLista]);

        // Devolver los resultados en formato JSON
        return response()->json([
            'Message' => 'OK',
            'Status' => 200,
            'Personal' => $resultados,
        ], 200);
    }

    public function SPA_Personal(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdTipoPersonaSistema' => 'required|integer',
            'IdTipoPersona' => 'required|integer',
            'IdTipoDomicilio' => 'required|integer',
            'Calle' => 'required|string|max:45',
            'Nro' => 'required|string|max:45',
            'Piso' => 'nullable|string|max:45',
            'IdLocalidad' => 'required|integer',
            'IdTipoDocumentacion' => 'required|integer',
            'Documentacion' => 'required|string|min:8|max:45',
            'Nombre' => 'required|string|max:45',
            'Apellido' => 'required|string|max:45',
            'Mail' => 'required|string|max:45',
            'FechaNacimiento' => ['required', 'date', 'before:today', function ($attribute, $value, $fail) {
                if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
                    $fail('El formato de la fecha de nacimiento es inválido.');
                }
            }],
            'Telefono' => 'required|string|min:10|max:45',
            'IdProvincia' => 'required|integer',
        ]);

        // Si la validación falla, devolver la respuesta correspondiente
        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->Errors(),
                'Status' => 400,
            ], 400);
        }

        // Obtener los datos del cuerpo de la solicitud
        $IdTipoPersonaSistema = $request->input('IdTipoPersonaSistema');
        $IdTipoPersona = $request->input('IdTipoPersona');
        $idTipoDomicilio = $request->input('IdTipoDomicilio');
        $calle = $request->input('Calle');
        $nro = $request->input('Nro');
        $piso = $request->input('Piso');
        $idLocalidad = $request->input('IdLocalidad');
        $idTipoDocumentacion = $request->input('IdTipoDocumentacion');
        $documentacion = $request->input('Documentacion');
        $nombre = $request->input('Nombre');
        $apellido = $request->input('Apellido');
        $mail = $request->input('Mail');
        $fechaNacimiento = $request->input('FechaNacimiento');
        $telefono = $request->input('Telefono');
        $idProvincia = $request->input('IdProvincia');


        // echo 'IdTipoPersonaSistema: ' . $IdTipoPersonaSistema . ', IdTipoPersona: ' . $IdTipoPersona . ', idTipoDomicilio: ' . $idTipoDomicilio . ', calle: ' . $calle . ', nro: ' . $nro . ', piso: ' . $piso . ', idLocalidad: ' . $idLocalidad . ', idTipoDocumentacion: ' . $idTipoDocumentacion . '<br>';
        // echo 'documentacion: ' . $documentacion . ', nombre: ' . $nombre . ', apellido: ' . $apellido . ', mail: ' . $mail . ', fechaNacimiento: ' . $fechaNacimiento . ', telefono: ' . $telefono . ', idProvincia: ' . $idProvincia . '<br>';
        

        // Ejecutar el procedimiento almacenado SPA_Personal
        $resultados = DB::select('CALL SPA_Personal(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $IdTipoPersonaSistema,
            $IdTipoPersona,
            $idTipoDomicilio,
            $calle,
            $nro,
            $piso,
            $idLocalidad,
            $idTipoDocumentacion,
            $documentacion,
            $nombre,
            $apellido,
            $mail,
            $fechaNacimiento,
            $telefono,
            $idProvincia
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

    public function SPM_Personal(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdPersonal' => 'required|integer',
            'IdTipoPersonaSistema' => 'required|integer',
            'IdTipoPersona' => 'required|integer',
            'IdTipoDomicilio' => 'required|integer',
            'Calle' => 'required|string|max:45',
            'Nro' => 'required|string|max:45',
            'Piso' => 'nullable|string|max:45',
            'IdLocalidad' => 'required|integer',
            'IdTipoDocumentacion' => 'required|integer',
            'Documentacion' => 'required|string|min:8|max:45',
            'Nombre' => 'required|string|max:45',
            'Apellido' => 'required|string|max:45',
            'Mail' => 'required|string|max:45',
            'FechaNacimiento' => ['required', 'date', 'before:today', function ($attribute, $value, $fail) {
                if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
                    $fail('El formato de la fecha de nacimiento es inválido.');
                }
            }],
            'Telefono' => 'required|string|min:10|max:45',
            'IdProvincia' => 'required|integer',
        ]);

        // Si la validación falla, devolver la respuesta correspondiente
        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->Errors(),
                'Status' => 400,
            ], 400);
        }

        // Obtener los datos del cuerpo de la solicitud
        $idPersonal = $request->input('IdPersonal');
        $IdTipoPersonaSistema = $request->input('IdTipoPersonaSistema');
        $IdTipoPersona = $request->input('IdTipoPersona');
        $idTipoDomicilio = $request->input('IdTipoDomicilio');
        $calle = $request->input('Calle');
        $nro = $request->input('Nro');
        $piso = $request->input('Piso');
        $idLocalidad = $request->input('IdLocalidad');
        $idTipoDocumentacion = $request->input('IdTipoDocumentacion');
        $documentacion = $request->input('Documentacion');
        $nombre = $request->input('Nombre');
        $apellido = $request->input('Apellido');
        $mail = $request->input('Mail');
        $fechaNacimiento = $request->input('FechaNacimiento');
        $telefono = $request->input('Telefono');
        $idProvincia = $request->input('IdProvincia');


        // echo  'IdPersonal:' . $idPersonal .'IdTipoPersonaSistema: ' . $IdTipoPersonaSistema . ', IdTipoPersona: ' . $IdTipoPersona . ', idTipoDomicilio: ' . $idTipoDomicilio . ', calle: ' . $calle . ', nro: ' . $nro . ', piso: ' . $piso . ', idLocalidad: ' . $idLocalidad . ', idTipoDocumentacion: ' . $idTipoDocumentacion . '<br>';
        // echo 'documentacion: ' . $documentacion . ', nombre: ' . $nombre . ', apellido: ' . $apellido . ', mail: ' . $mail . ', fechaNacimiento: ' . $fechaNacimiento . ', telefono: ' . $telefono . ', idProvincia: ' . $idProvincia . '<br>';
        
        // Ejecutar el procedimiento almacenado SPM_Personal
        $resultados = DB::select('CALL SPM_Personal(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $idPersonal,
            $IdTipoPersonaSistema,
            $IdTipoPersona,
            $idTipoDomicilio,
            $calle,
            $nro,
            $piso,
            $idLocalidad,
            $idTipoDocumentacion,
            $documentacion,
            $nombre,
            $apellido,
            $mail,
            $fechaNacimiento,
            $telefono,
            $idProvincia
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

    public function SPB_Personal(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdPersonal' => 'required|integer',
            'Token' => 'required|string|max:500',
        ]);

        // Si la validación falla, devolver la respuesta correspondiente
        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->Errors(),
                'Status' => 400,
            ], 400);
        }

        // Obtener los datos del cuerpo de la solicitud
        $IdPersonal = $request->input('IdPersonal');
        $token = $request->input('Token');


        // Ejecutar el procedimiento almacenado SPB_Personal
        $resultados = DB::select('CALL SPB_Personal(?, ?)', [
            $IdPersonal, 
            $token
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

    public function SPH_Personal(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'Token' => 'required|string|max:500',
            'IdPersonal' => 'required|integer',
        ]);

        // Si la validación falla, devolver la respuesta correspondiente
        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->Errors(),
                'Status' => 400,
            ], 400);
        }

        // Obtener los datos del cuerpo de la solicitud
        $IdPersonal = $request->input('IdPersonal');
        $token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPH_Personal
        $resultados = DB::select('CALL SPH_Personal(?, ?)', [
            $IdPersonal,
            $token
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

}
