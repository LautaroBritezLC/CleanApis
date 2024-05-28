<?php

namespace App\Http\Controllers\Api\Recursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function SPL_Cliente(Request $request) {
        // Ejecutar el procedimiento almacenado SPL_Personal
        $resultados = DB::select('CALL SPL_Cliente()');

        // Devolver los resultados en formato JSON
        return response()->json([
            'Message' => 'OK',
            'Status' => 200,
            'Cliente' => $resultados,
        ], 200);
    }

    public function SPA_Clientes(Request $request) {
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
        'RazonSocial' => 'required|string|max:45',
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
            'Errors' => $validator->errors(),
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
    $razonSocial = $request->input('RazonSocial');
    $fechaNacimiento = $request->input('FechaNacimiento');
    $telefono = $request->input('Telefono');
    $idProvincia = $request->input('IdProvincia');

    // // Echo de los datos obtenidos
    // echo 'IdTipoPersonaSistema: ' . $IdTipoPersonaSistema . ', IdTipoPersona: ' . $IdTipoPersona . ', IdTipoDomicilio: ' . $idTipoDomicilio . ', Calle: ' . $calle . ', Nro: ' . $nro . ', Piso: ' . $piso . ', IdLocalidad: ' . $idLocalidad . ', IdTipoDocumentacion: ' . $idTipoDocumentacion . ', Documentacion: ' . $documentacion . ', Nombre: ' . $nombre . ', Apellido: ' . $apellido . ', Mail: ' . $mail . ', RazonSocial: ' . $razonSocial . ', FechaNacimiento: ' . $fechaNacimiento . ', Telefono: ' . $telefono . ', IdProvincia: ' . $idProvincia . '<br>';


    // Ejecutar el procedimiento almacenado SPA_Clientes
    $resultados = DB::select('CALL SPA_Clientes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
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
        $razonSocial,
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

    public function SPM_Cliente(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdCliente' => 'required|integer',
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
            'RazonSocial' => 'required|string|max:45',
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
                'Errors' => $validator->errors(),
                'Status' => 400,
            ], 400);
        }

        // Obtener los datos del cuerpo de la solicitud
        $idCliente = $request->input('IdCliente');
        $idTipoPersonaSistema = $request->input('IdTipoPersonaSistema');
        $idTipoPersona = $request->input('IdTipoPersona');
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
        $razonSocial = $request->input('RazonSocial');
        $fechaNacimiento = $request->input('FechaNacimiento');
        $telefono = $request->input('Telefono');
        $idProvincia = $request->input('IdProvincia');

        // echo "IdCliente: $idCliente, IdTipoPersonaSistema: $idTipoPersonaSistema, IdTipoPersona: $idTipoPersona, IdTipoDomicilio: $idTipoDomicilio, Calle: $calle, Nro: $nro, Piso: $piso, IdLocalidad: $idLocalidad, IdTipoDocumentacion: $idTipoDocumentacion, Documentacion: $documentacion, Nombre: $nombre, Apellido: $apellido, Mail: $mail, RazonSocial: $razonSocial, FechaNacimiento: $fechaNacimiento, Telefono: $telefono, IdProvincia: $idProvincia";

        // Ejecutar el procedimiento almacenado SPM_Cliente
        $resultados = DB::select('CALL SPM_Cliente(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $idCliente,
            $idTipoPersonaSistema,
            $idTipoPersona,
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
            $razonSocial,
            $fechaNacimiento,
            $telefono,
            $idProvincia
        ]);

        // Obtener el mensaje del resultado
        $mensaje = isset($resultados[0]->v_Message) ? $resultados[0]->v_Message : null;

        // Verificar si el mensaje es 'OK'
        if ($mensaje === 'OK') {
            // Devolver los resultados como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
            ], 200);
        } else {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        }
    }


    public function SPB_Cliente(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdCliente' => 'required|integer',
        ]);

        // Si la validación falla, devolver la respuesta correspondiente
        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->errors(),
                'Status' => 400,
            ], 400);
        }

        // Obtener el IdCliente del cuerpo de la solicitud
        $idCliente = $request->input('IdCliente');

        // Ejecutar el procedimiento almacenado SPB_Cliente
        $resultados = DB::select('CALL SPB_Cliente(?)', [$idCliente]);

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


    public function SPH_Cliente(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdCliente' => 'required|integer',
        ]);

        // Si la validación falla, devolver la respuesta correspondiente
        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->errors(),
                'Status' => 400,
            ], 400);
        }

        // Obtener el IdCliente del cuerpo de la solicitud
        $idCliente = $request->input('IdCliente');
        
        // Ejecutar el procedimiento almacenado SPH_Cliente
        $resultados = DB::select('CALL SPH_Cliente(?)', [$idCliente]);

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
