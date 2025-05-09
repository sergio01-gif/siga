<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirecionarPorTipo
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $user = Auth::user();
        $rotaAtual = $request->route()->getName();
    
        // Lista de permissões por tipo
        $permissoes = [
            'admin' => [
                'dashboard', 'usuarios.index', 'cursos.index', 'ano_academicos.index', 'turmas.index', 'cadeiras.index'
            ],
            'professor' => [
                'professor.dashboard', 'aulas.index'
            ],
            'estudante' => [
                'estudante.dashboard', 'matriculas.index'
            ],
            'coordenador_estagio' => [
                'coordenador_estagio.dashboard', 'Cadeiras.index'
            ],
            // outros tipos...
        ];
    
        // Verifica se o tipo de usuário tem permissão para acessar a rota
        if (isset($permissoes[$user->tipo_usuario]) && in_array($rotaAtual, $permissoes[$user->tipo_usuario])) {
            return $next($request);
        }
    
        // Se não tiver permissão
        abort(403, 'Tipo de usuário não autorizado.');
    }
}  