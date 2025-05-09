<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Matricula;
use App\Models\Nota;
use App\Models\Mensalidade;
use App\Models\Estagio;
use App\Models\Emprestimo;
use App\Models\Pagamento;

class EstudanteDashboardController extends Controller
{
    public function index()
    {
        $estudante = Auth::user();

        // Matrícula mais recente com curso, turma e ano letivo
        $matricula = Matricula::with(['curso', 'turma', 'ano_lectivo'])
            ->where('estudante_id', $estudante->id)
            ->latest()
            ->first();

        // Últimas 5 notas com disciplina
        $notas = Nota::where('estudante_id', $estudante->id)
            ->with('disciplina')
            ->latest()
            ->take(5)
            ->get();

        // Contadores de mensalidades
        $mensalidadesPagas = Mensalidade::where('estudante_id', $estudante->id)
            ->where('estado', 'pago')
            ->count();

        $mensalidadesPendentes = Mensalidade::where('estudante_id', $estudante->id)
            ->where('estado', 'pendente')
            ->count();

        // Estágio mais recente
        $estagio = Estagio::where('estudante_id', $estudante->id)
            ->latest()
            ->first();

        // Últimos 5 empréstimos de livros
        $emprestimos = Emprestimo::with('livro')
            ->where('estudante_id', $estudante->id)
            ->orderByDesc('data_emprestimo')
            ->take(5)
            ->get();

        // Pagamentos do estudante
        $pagamentos = Pagamento::where('estudante_id', $estudante->id)
            ->latest()
            ->get();

        return view('estudantes.dashboard', compact(
            'estudante',
            'matricula',
            'notas',
            'mensalidadesPagas',
            'mensalidadesPendentes',
            'estagio',
            'emprestimos',
            'pagamentos'
        ));
    }
}
