<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTipoUsuario
{
    public function handle(Request $request, Closure $next, $tipo)
    {
        if (!Auth::check() || Auth::user()->tipo_usuario !== $tipo) {
            abort(403, 'Acesso não autorizado');
        }

        return $next($request);
    }
}

