<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Carbon\Carbon;
use app\Models\Usuario;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('token') && $request->has('usuario_id')) {
            $admin = Admin::where('usuario_id', $request->input('usuario_id'))
                ->first();

            return $next($request);
        } else {
            return response()->json(['message' => 'Usuário não é administrador', 'erro' => 's'], 200);
        }
    }
}
