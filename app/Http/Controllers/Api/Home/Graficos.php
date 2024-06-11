<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Graficos extends Controller
{
    public function SPG_ObtenerCantPersonalPorSucursal(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
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
        $Token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPG_ObtenerCantPersonalPorSucursal
        $resultados = DB::select('CALL SPG_ObtenerCantPersonalPorSucursal(?)', [$Token]);

        // Obtener el mensaje o los resultados del resultado
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;
        $cantPersonalSucursal = isset($resultados[0]->Sucursal) ? $resultados : null;
        // Verificar si hay un mensaje de error
        if ($mensaje !== null) {
            // Devolver el mensaje de error
            return [
                'Message' => $mensaje,
                'Status' => 400,
            ];
        } else {
            // Devolver la cantidad de personal como respuesta
            return [
                'Message' => 'OK',
                'Status' => 200,
                'cantPersonalSucursal' => $cantPersonalSucursal,
            ];
        }
    }

    public function SPG_ObtenerCantPersonalTotal(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
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
        $token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPG_ObtenerCantPersonalTotal
        $resultados = DB::select('CALL SPG_ObtenerCantPersonalTotal(?)', [$token]);

        // Obtener el mensaje o cantidad de personal total del resultado
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;
        $PersonalTotal = isset($resultados[0]->PersonalTotal) ? $resultados[0]->PersonalTotal : null;

        // Verificar si hay un mensaje de error
        if ($mensaje !== null) {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        } else {
            // Devolver la cantidad de personal total como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'PersonalTotal' => $PersonalTotal,
            ], 200);
        }
    }

    public function SPG_ObtenerStockSucursal(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
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

        // Obtener el token del cuerpo de la solicitud
        $token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPG_ObtenerStockSucursal
        $resultados = DB::select('CALL SPG_ObtenerStockSucursal(?)', [$token]);

        // Obtener el mensaje o los resultados del resultado
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;
        $stockSucursal = isset($resultados[0]->TotalProductos) ? $resultados : null;

        // Verificar si hay un mensaje de error
        if ($mensaje !== null) {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        } else {
            // Devolver los resultados como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'StockSucursal' => $stockSucursal,
            ], 200);
        }
    }

    public function SPG_ObtenerStockSucursalPorCategoria(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'IdCategoria' => 'required|integer',
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
        $idCategoria = $request->input('IdCategoria');
        $token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPG_ObtenerStockSucursalPorCategoria
        $resultados = DB::select('CALL SPG_ObtenerStockSucursalPorCategoria(?, ?)', [$idCategoria, $token]);

        // Obtener el mensaje o los resultados del resultado
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;
        $stockSucursalPorCategoria = isset($resultados[0]->Sucursal) ? $resultados : null;

        // Verificar si hay un mensaje de error
        if ($mensaje !== null) {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        } else {
            // Devolver los resultados como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'StockSucursalPorCategoria' => $stockSucursalPorCategoria,
            ], 200);
        }
    }

    public function SPG_ObtenerCantProductos(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
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
        $token = $request->input('Token');

        // Ejecutar el procedimiento almacenado SPG_ObtenerCantProductos
        $resultados = DB::select('CALL SPG_ObtenerCantProductos(?)', [$token]);

        // Obtener el mensaje o cantidad de productos del resultado
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;
        $cantProductos = isset($resultados[0]->CantProductos) ? $resultados[0]->CantProductos : null;

        // Verificar si hay un mensaje de error
        if ($mensaje !== null) {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        } else {
            // Devolver la cantidad de productos como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'CantProductos' => $cantProductos,
            ], 200);
        }
    }

    public function SPG_ObtenerCantProductosPorSucursal(Request $request) {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
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
        $token = $request->input('Token');
    
        // Ejecutar el procedimiento almacenado SPG_ObtenerCantProductosPorSucursal
        $resultados = DB::select('CALL SPG_ObtenerCantProductosPorSucursal(?)', [$token]);
    
        // Obtener el mensaje o los resultados de la cantidad de productos por sucursal
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;
    
        // Verificar si hay un mensaje de error
        if ($mensaje !== null) {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        } else {
            // Devolver los resultados como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'CantProductosPorSucursal' => $resultados,
            ], 200);
        }
    }
    

    public function SPG_ObtenerCantProveedores(Request $request) {

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
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
        $token = $request->input('Token');
    
        // Ejecutar el procedimiento almacenado SPG_ObtenerCantProductosPorSucursal
        $resultados = DB::select('CALL SPG_ObtenerCantProveedores(?)', [$token]);
    
        // Obtener el mensaje o los resultados de la cantidad de productos por sucursal
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;
        $CantProveedores = isset($resultados[0]->CantProveedores) ? $resultados[0]->CantProveedores : null;
    
        // Verificar si hay un mensaje de error
        if ($mensaje !== null) {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        } else {
            // Devolver los resultados como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'CantProveedores' => $CantProveedores,
            ], 200);
        }
    }

    public function SPG_ObtenerCantClientes(Request $request) {

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
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
        $token = $request->input('Token');
    
        // Ejecutar el procedimiento almacenado SPG_ObtenerCantProductosPorSucursal
        $resultados = DB::select('CALL SPG_ObtenerCantClientes(?)', [$token]);
    
        // Obtener el mensaje o los resultados de la cantidad de productos por sucursal
        $mensaje = isset($resultados[0]->Message) ? $resultados[0]->Message : null;
        $CantClientes = isset($resultados[0]->CantClientes) ? $resultados[0]->CantClientes : null;
    
        // Verificar si hay un mensaje de error
        if ($mensaje !== null) {
            // Devolver el mensaje de error
            return response()->json([
                'Message' => $mensaje,
                'Status' => 400,
            ], 400);
        } else {
            // Devolver los resultados como respuesta
            return response()->json([
                'Message' => 'OK',
                'Status' => 200,
                'CantClientes' => $CantClientes,
            ], 200);
        }
    }

}
