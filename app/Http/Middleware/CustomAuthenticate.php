<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class CustomAuthenticate extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            // Intenta autenticar al usuario utilizando el token JWT presente en la solicitud
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            // Si ocurre un error al analizar el token JWT, devuelve una respuesta de error 401
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Si el usuario no es autenticado, devuelve una respuesta de error 401
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Si el usuario está autenticado, permite continuar con la solicitud
        return $next($request);
    }
}
