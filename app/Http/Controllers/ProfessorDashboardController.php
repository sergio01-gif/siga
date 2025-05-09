<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cadeira;
use App\Models\Turma;
use App\Models\Estudante;
use App\Models\Nota;

class ProfessorDashboardController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        // Verifica se o usuário autenticado tem tipo professor
        if ($usuario->tipo_usuario !== 'professor') {
            abort(403, 'Acesso não autorizado');
        }

        // Verifica se há um professor vinculado ao usuário
        $professor = $usuario->professor; // relacionamento: hasOne(Professor::class, 'usuario_id')

        if (!$professor) {
            return redirect()->route('login')->withErrors([
                'email' => 'Nenhum perfil de professor vinculado a este usuário.'
            ]);
        }

        // Disciplinas (cadeiras) do professor
        $cadeiras = Cadeira::with('turma')
            ->where('professor_id', $professor->id)
            ->get();

        // Turmas relacionadas às cadeiras
        $turmas = Turma::whereIn('id', $cadeiras->pluck('turma_id'))->get();

        // Total de estudantes nas turmas
        $totalEstudantes = Estudante::whereIn('turma_id', $turmas->pluck('id'))->count();

        // Total de notas lançadas
        $totalNotas = Nota::whereIn('cadeira_id', $cadeiras->pluck('id'))->count();

        return view('professores.dashboard', compact(
            'professor',
            'cadeiras',
            'turmas',
            'totalEstudantes',
            'totalNotas'
        ));
    }
}
