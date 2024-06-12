<?php

namespace App\Http\Controllers\Api\Recursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function guardarAumentosProducto(Request $request)

    
    {

        $idProducto = $request->input('IdProducto');
        $aumentos = $request->input('Aumentos');
        $aumentoExtra = $request->input('AumentoExtra');
        $token = $request->input('Token');

        try {
            DB::statement('CALL SPM_AumentosProducto(?, ?, ?, ?)', [
                $idProducto, json_encode($aumentos), $aumentoExtra , $token 
            ]);
            return response()->json(['message' => 'Aumentos guardados exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al guardar aumentos', 'error' => $e->getMessage()], 500);
        }
    }

    public function SPL_TipoAumento(Request $request) {
        $resultados = DB::select('CALL SPL_TipoAumento()');

        return response()->json([
            'Message' => 'OK',
            'Status' => 200,
            'TiposAumento' => $resultados,
        ], 200);
    }
    public function AumentoPorProducto(Request $request) {
        $validator = Validator::make($request->all(), [
            'IdProducto' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Error en la validación de los datos',
                'Errors' => $validator->errors(),
                'Status' => 400,
            ], 400);
        }

        $idProducto = $request->query('IdProducto'); // Para solicitudes GET
        try {
            $resultados = DB::select('CALL SPL_AumentoPorProducto(?)', [$idProducto]);
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'Aumentos' => $resultados,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'Message' => 'Error al ejecutar la consulta',
                'Errors' => $e->getMessage(),
                'Status' => 500,
            ], 500);
        }
    }

    public function SPL_Producto(Request $request) {
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
        // Ejecutar el procedimiento almacenado SPL_Producto
        $resultados = DB::select('CALL SPL_Producto(?)', [$tipoLista]);

        // Devolver los resultados obtenidos
        return response()->json([
            'Message' => 'OK',
            'Status' => 200,
            'Productos' => $resultados,
        ], 200);
    }

    public function SPA_Producto(Request $request) {
    // Validar los datos de entrada
    $validator = Validator::make($request->all(), [
        'IdTipoMedida' => 'required|integer',
        'IdTipoCategoria' => 'required|integer',
        'IdTipoProducto' => 'required|integer',
        'IdPersona' => 'required|integer',
        'Codigo' => 'required|string|min:8',
        'Nombre' => 'required|string|max:45',
        'Marca' => 'required|string|max:45',
        'PrecioCosto' => 'required|numeric|min:0',
        'Tamano' => 'required|numeric|min:0',
        'CantMinima' => 'required|integer|min:0',
        'CantMaxima' => 'required|integer|min:0',
        'Token' => 'required|string',
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
    $IdTipoMedida = $request->input('IdTipoMedida');
    $idTipoCategoria = $request->input('IdTipoCategoria');
    $idTipoProducto = $request->input('IdTipoProducto');
    $codigo = $request->input('Codigo');
    $nombre = $request->input('Nombre');
    $IdPersona = $request->input('IdPersona');
    $marca = $request->input('Marca');
    $precioCosto = $request->input('PrecioCosto');
    $Tamano = $request->input('Tamano');
    $cantMinima = $request->input('CantMinima');
    $cantMaxima = $request->input('CantMaxima');
    $token = $request->input('Token');


    // echo "IdTipoMedida: $IdTipoMedida, idTipoCategoria: $idTipoCategoria, idTipoProducto: $idTipoProducto, ";
    // echo "codigo: $codigo, nombre: $nombre, marca: $marca, precioCosto: $precioCosto, ";
    // echo "Tamano: $Tamano, cantMinima: $cantMinima, cantMaxima: $cantMaxima, idUsuarioCarga: $idUsuarioCarga";


    // Ejecutar el procedimiento almacenado SPA_Producto
    $resultados = DB::select('CALL SPA_Producto(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
        $IdTipoMedida, $idTipoCategoria, $idTipoProducto,  $codigo, $nombre,$IdPersona,
         $marca, $precioCosto, $Tamano, $cantMinima, $cantMaxima, $token
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

    public function SPM_Producto(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdProducto' => 'required|integer',
            'IdTipoMedida' => 'required|integer',
            'IdTipoCategoria' => 'required|integer',
            'IdTipoProducto' => 'required|integer',
            'IdPersona' => 'required|integer',
            'Codigo' => 'required|string|min:8',
            'Nombre' => 'required|string|max:45',
            'Marca' => 'required|string|max:45',
            'PrecioCosto' => 'required|numeric|min:0',
            'Tamano' => 'required|numeric|min:0',
            'CantMinima' => 'required|integer|min:0',
            'CantMaxima' => 'required|integer|min:0',
            'Token' => 'required|string',
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
        $idProducto = $request->input('IdProducto');
        $IdTipoMedida = $request->input('IdTipoMedida');
        $idTipoCategoria = $request->input('IdTipoCategoria');
        $idTipoProducto = $request->input('IdTipoProducto');
        $IdPersona = $request->input('IdPersona');
        $codigo = $request->input('Codigo');
        $nombre = $request->input('Nombre');
        $marca = $request->input('Marca');
        $precioCosto = $request->input('PrecioCosto');
        $Tamano = $request->input('Tamano');
        $cantMinima = $request->input('CantMinima');
        $cantMaxima = $request->input('CantMaxima');
        $token = $request->input('Token');


        // Ejecutar el procedimiento almacenado SPM_Producto
        $resultados = DB::select('CALL SPM_Producto(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)', [
            $idProducto, $IdTipoMedida, $idTipoCategoria, $idTipoProducto, $codigo, $nombre, $IdPersona , $marca,
            $precioCosto, $Tamano, $cantMinima, $cantMaxima, $token
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

    public function SPB_Producto(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdProducto' => 'required|integer',
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
        $idProducto = $request->input('IdProducto');

        // Ejecutar el procedimiento almacenado SPB_Producto
        $resultados = DB::select('CALL SPB_Producto(?)', [
            $idProducto
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

    public function SPH_Producto(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdProducto' => 'required|integer',
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
        $idProducto = $request->input('IdProducto');

        // Ejecutar el procedimiento almacenado SPH_Producto
        $resultados = DB::select('CALL SPH_Producto(?)', [
            $idProducto
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

    public function SPA_AgregarStock(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdProducto' => 'required|integer',
            'Cantidad' => 'required|integer',
            'Token' => 'required|string',
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
        $idProducto = $request->input('IdProducto');
        $Cantidad = $request->input('Cantidad');
        $Token = $request->input('Token');

        // echo $idProducto .' '. $Cantidad  . '' . $Token;

        // Ejecutar el procedimiento almacenado SPH_Producto
        $resultados = DB::select('CALL SPA_AgregarStock(?,?,?)', [
            $idProducto,
            $Cantidad,
            $Token
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

    public function SPM_AumentoEnMasa(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'productos' => 'required|array',
            'productos.*.IdProducto' => 'nullable|integer',
            'productos.*.PrecioCosto' => 'nullable|numeric',
            'PorcentajeExtra' => 'required|numeric',
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
        $productos = $request->input('productos');
        $porcentajeExtra = $request->input('PorcentajeExtra');
        $token = $request->input('Token');

        // Construir el array de objetos JSON en el formato requerido
        $json_array = [];
        $json_array[] = ['Token' => $token];
        $json_array[] = ['PorcentajeExtra' => $porcentajeExtra];
        foreach ($productos as $producto) {
            $json_array[] = $producto;
        }

        // Convertir el array a JSON
        $json_data = json_encode($json_array);

        // echo $json_data;
        // Ejecutar el procedimiento almacenado SPM_AumentoEnMasa
        $resultados = DB::select('CALL SPM_AumentoEnMasa(?)', [$json_data]);

        // Obtener el mensaje del resultado
        $mensaje = $resultados[0]->ResultMessage;

        
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