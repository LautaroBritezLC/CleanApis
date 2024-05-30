<?php

namespace App\Http\Controllers\Api\Recursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function SPL_Producto(Request $request) {
        // Ejecutar el procedimiento almacenado SPL_Producto
        $resultados = DB::select('CALL SPL_Producto()');

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
    $resultados = DB::select('CALL SPA_Producto(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
        $IdTipoMedida, $idTipoCategoria, $idTipoProducto, $codigo, $nombre, $marca, $precioCosto, $Tamano, $cantMinima, $cantMaxima, $token
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
            'Codigo' => 'required|string|min:8',
            'Nombre' => 'required|string|max:45',
            'Marca' => 'required|string|max:45',
            'PrecioCosto' => 'required|numeric|min:0',
            'Tamano' => 'required|numeric|min:0',
            'CantMinima' => 'required|integer|min:0',
            'CantMaxima' => 'required|integer|min:0',
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
        $codigo = $request->input('Codigo');
        $nombre = $request->input('Nombre');
        $marca = $request->input('Marca');
        $precioCosto = $request->input('PrecioCosto');
        $Tamano = $request->input('Tamano');
        $cantMinima = $request->input('CantMinima');
        $cantMaxima = $request->input('CantMaxima');
        $token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPM_Producto
        $resultados = DB::select('CALL SPM_Producto(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $idProducto, $IdTipoMedida, $idTipoCategoria, $idTipoProducto, $codigo, $nombre, $marca, 
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
}
