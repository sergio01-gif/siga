<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request); // Permite o acesso se o papel for adequado
        }

        // Redireciona para a página de login se o papel não for adequado
        return redirect()->route('login')->withErrors(['role' => 'Tipo de usuário não autorizado.']);
    }
}
