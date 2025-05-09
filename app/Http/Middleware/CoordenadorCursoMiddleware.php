<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CoordenadorCursoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->tipo_usuario === 'coordenador_de_curso') {
            return $next($request);
        }
    
        return redirect()->back()->with('error', 'Acesso não autorizado.');
    }
    
}
