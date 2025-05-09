<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudanteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'estudante') {
            return $next($request);
        }
        return redirect('/'); // Redireciona para a home se não for aluno
    }
}
