<?php

namespace App\Http\Controllers\Api\Recursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    public function SPL_Proveedor(Request $request) {
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

        // Ejecutar el procedimiento almacenado SPL_Proveedor
        $resultados = DB::select('CALL SPL_Proveedor(?)', [$tipoLista]);

        // Obtener el mensaje del resultado
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;

        // Verificar si el mensaje es nulo (para el caso de que el tipo de lista sea válido)
        if ($mensaje === null) {
            // Devolver los resultados como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'Proveedores' => $resultados,
            ], 200);
        } else {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        }
    }

    public function SPA_Proveedor(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdTipoPersona' => 'required|integer',
            'IdTipoDomicilio' => 'required|integer',
            'Calle' => 'required|string|max:45',
            'Nro' => 'required|string|max:45',
            'Piso' => 'nullable|string|max:45',
            'IdLocalidad' => 'required|integer',
            'IdTipoDocumentacion' => 'required|integer',
            'Documentacion' => 'required|string|min:8|max:45',
            'Mail' => 'required|string|max:45',
            'RazonSocial' => 'required|string|max:45',
            'Telefono' => 'required|string|min:10|max:45',
            'IdProvincia' => 'required|integer',
            'Token' => 'required|string',
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
        $IdTipoPersona = $request->input('IdTipoPersona');
        $IdTipoDomicilio = $request->input('IdTipoDomicilio');
        $Calle = $request->input('Calle');
        $Nro = $request->input('Nro');
        $Piso = $request->input('Piso');
        $IdLocalidad = $request->input('IdLocalidad');
        $IdTipoDocumentacion = $request->input('IdTipoDocumentacion');
        $Documentacion = $request->input('Documentacion');
        $Mail = $request->input('Mail');
        $RazonSocial = $request->input('RazonSocial');
        $Telefono = $request->input('Telefono');
        $IdProvincia = $request->input('IdProvincia');
        $Token = $request->input('Token');
    
        // Ejecutar el procedimiento almacenado SPA_Proveedor
        $resultados = DB::select('CALL SPA_Proveedor(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $IdTipoPersona,
            $IdTipoDomicilio,
            $Calle,
            $Nro,
            $Piso,
            $IdLocalidad,
            $IdTipoDocumentacion,
            $Documentacion,
            $Mail,
            $RazonSocial,
            $Telefono,
            $IdProvincia,
            $Token
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
    

    public function SPM_Proveedor(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdTipoPersona' => 'required|integer',
            'IdTipoDomicilio' => 'required|integer',
            'Calle' => 'required|string|max:45',
            'Nro' => 'required|string|max:45',
            'Piso' => 'nullable|string|max:45',
            'IdLocalidad' => 'required|integer',
            'IdTipoDocumentacion' => 'required|integer',
            'Documentacion' => 'required|string|min:8|max:45',
            'Mail' => 'required|string|max:45',
            'RazonSocial' => 'required|string|max:45',
            'Telefono' => 'required|string|min:10|max:45',
            'IdProvincia' => 'required|integer',
            'Token' => 'required|string',
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
        $IdTipoPersona = $request->input('IdTipoPersona');
        $IdTipoDomicilio = $request->input('IdTipoDomicilio');
        $Calle = $request->input('Calle');
        $Nro = $request->input('Nro');
        $Piso = $request->input('Piso');
        $IdLocalidad = $request->input('IdLocalidad');
        $IdTipoDocumentacion = $request->input('IdTipoDocumentacion');
        $Documentacion = $request->input('Documentacion');
        $Mail = $request->input('Mail');
        $RazonSocial = $request->input('RazonSocial');
        $Telefono = $request->input('Telefono');
        $IdProvincia = $request->input('IdProvincia');
        $Token = $request->input('Token');
    
        // Ejecutar el procedimiento almacenado SPA_Proveedor
        $resultados = DB::select('CALL SPA_Proveedor(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $IdTipoPersona,
            $IdTipoDomicilio,
            $Calle,
            $Nro,
            $Piso,
            $IdLocalidad,
            $IdTipoDocumentacion,
            $Documentacion,
            $Mail,
            $RazonSocial,
            $Telefono,
            $IdProvincia,
            $Token
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
    

    public function SPB_Proveedor(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdPersona' => 'required|integer',
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

        // Obtener el IdCliente del cuerpo de la solicitud
        $IdPersona = $request->input('IdPersona');
        $token = $request->input('Token');

        // echo $IdProveedor .  $token ;

        // Ejecutar el procedimiento almacenado SPB_Cliente
        $resultados = DB::select('CALL SPB_Proveedor(?,?)', [$IdPersona, $token]);

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
    public function SPH_Proveedor(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdPersona' => 'required|integer',
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

        // Obtener el IdCliente del cuerpo de la solicitud
        $IdPersona = $request->input('IdPersona');
        $token = $request->input('Token');

        // echo $IdProveedor .  $token ;

        // Ejecutar el procedimiento almacenado SPB_Cliente
        $resultados = DB::select('CALL SPH_Proveedor(?,?)', [$IdPersona, $token]);

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
