<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidarBearerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $methodConsume = $request->method(); // Obtiene el método HTTP
        $routeConsume = str_replace('api/', '', $request->path()); // Remueve el prefijo 'api/'
        $token = $request->input('Token');

        // Implementar la lógica de validación aquí
        $mensajeValidacion = $this->validarBearer($token, $methodConsume, $routeConsume);

        if ($mensajeValidacion !== 'Ok') {
            return response()->json([
                'mensajeValidacion' => 'No posee permisos para realizar la acción',
                'Status' => 400,
            ], 400);
        }

        return $next($request);
    }

    private function validarBearer($usuarioBearer, $methodConsume, $routeConsume)
    {
        // echo $usuarioBearer . ' ' . $methodConsume . ' ' . $routeConsume;
        $result = DB::select('CALL SPP_ValidarBearer_API(?, ?, ?)', [
            $usuarioBearer,
            $methodConsume,
            $routeConsume,
        ]);

        return $result[0]->Mensaje ?? 'Error';
    }
}
