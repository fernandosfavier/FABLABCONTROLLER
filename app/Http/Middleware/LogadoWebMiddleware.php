<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UsuarioToken;
use App\Models\Usuario;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;

class LogadoWebMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Cookie::has('token') && Cookie::has('usuario_id')) {

            $usuario_id = Cookie::get('usuario_id');
            $token = Cookie::get('token');

            $token_usuario = UsuarioToken::where('usuario_id', $usuario_id)
                ->where('token', $token)
                ->where('valido_ate', '>', Carbon::now())
                ->first();

            if ($token_usuario) {

                $usuario = Usuario::find($usuario_id);

                if ($usuario) {
                    $request->merge([
                        'usuario' => $usuario
                    ]);

                    return $next($request);
                }
            }
        }

        Cookie::queue(Cookie::forget('usuario_id'));
        Cookie::queue(Cookie::forget('token'));

        return redirect()->route('loginteste');
    }
}
