<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\UsuarioToken;
use Carbon\Carbon;
use app\Models\Usuario;

class LogoutMiddleware
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
                ->first();

            if ($token) {
                $token->delete();

                return response()->json(['message' => 'Logout realizado com sucesso', 'erro' => 'n'], 200);
            } else {
                return response()->json(['message' => 'Token inválido', 'erro' => 's'], 200);
            }
        } else {
            return response()->json(['message' => 'Token ou usuario_id não fornecido', 'erro' => 's'], 200);
        }
    }
}