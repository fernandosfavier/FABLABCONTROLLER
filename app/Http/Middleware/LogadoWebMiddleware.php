<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UsuarioToken;
use App\Models\Usuario;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use App\Models\Admin;
class LogadoWebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cookie::has('token') && Cookie::has('usuario_id')) {
            $usuario_id = Cookie::get('usuario_id');
            $token = Cookie::get('token');
            $token_usuario = UsuarioToken::where('usuario_id', $usuario_id)
                ->where('token', $token)
                ->where('valido_ate', '>', Carbon::now())
                ->first();
                if($token_usuario){
                    $usuario = Usuario::find($usuario_id);
                    $request->usuario = $usuario;
                    $admin = Admin::where('usuario_id', $usuario_id)->first();
                    if($admin) {
                        $request->admin = 'S';
                    } else {
                        $request->admin = 'N';
                    }
                    return $next($request);
                }
                else{
                    dd("CAI AQUI 1");
                    Cookie::forget('usuario_id');
                    Cookie::forget('token');
                    return redirect()->route('loginteste'); 
                }
            
        } else {
            dd("CAI AQUI 2");
            Cookie::forget('usuario_id');
            Cookie::forget('token');
            return redirect()->route('loginteste');                 
    }
    }
}
