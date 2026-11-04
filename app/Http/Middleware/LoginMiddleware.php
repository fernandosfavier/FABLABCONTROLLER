<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\UsuarioToken;
use Carbon\Carbon;
use app\Models\Usuario;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('token') && $request->has('usuario_id')) {
            $token = UsuarioToken::where('usuario_id', $request->input('usuario_id'))
                ->where('token', $request->input('token'))
                ->where('valido_ate', '>', Carbon::now())
                ->first();

            return $next($request);
        } else {
            return response()->json(['message' => 'Token inválido ou expirado', 'erro' => 's'], 200);
        }
    }
}