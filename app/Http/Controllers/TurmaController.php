<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Curso;
use App\Models\AnoAcademico;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index(Request $request)
    {
        $cursoId = $request->curso_id;
        $anoId = $request->ano_academico_id;

        $turmas = Turma::with(['curso', 'anoAcademico'])
            ->when($cursoId, fn($q) => $q->where('curso_id', $cursoId))
            ->when($anoId, fn($q) => $q->where('ano_academico_id', $anoId))
            ->orderByDesc('created_at')
            ->paginate(10);

        $cursos = Curso::all();
        $anoAcademicos = AnoAcademico::all();

        return view('turmas.index', compact('turmas', 'cursos', 'anoAcademicos', 'cursoId', 'anoId'));
    }

    public function create()
    {
        $cursos = Curso::all();
        $anoAcademicos = AnoAcademico::all();
        return view('turmas.create', compact('cursos', 'anoAcademicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'ano_academico_id' => 'required|exists:anos_academicos,id',
        ]);

        Turma::create([
            'nome' => $request->nome,
            'curso_id' => $request->curso_id,
            'ano_academico_id' => $request->ano_academico_id,
        ]);

        return redirect()->route('turmas.index')->with('success', 'Turma criada com sucesso!');
    }

    public function show(Turma $turma)
    {
        return view('turmas.show', compact('turma'));
    }

    public function edit(Turma $turma)
    {
        $cursos = Curso::all();
        $anoAcademicos = AnoAcademico::all();
        return view('turmas.edit', compact('turma', 'cursos', 'anoAcademicos'));
    }

    public function update(Request $request, Turma $turma)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'ano_academico_id' => 'required|exists:anos_academicos,id',
        ]);

        $turma->update([
            'nome' => $request->nome,
            'curso_id' => $request->curso_id,
            'ano_academico_id' => $request->ano_academico_id,
        ]);

        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy(Turma $turma)
    {
        $turma->delete();
        return redirect()->route('turmas.index')->with('success', 'Turma excluída com sucesso!');
    }

    public function turmasPorAno(AnoAcademico $anoAcademico)
    {
        $turmas = Turma::where('ano_academico_id', $anoAcademico->id)->get();
        return view('turmas.turmas_por_ano', compact('turmas', 'anoAcademico'));
    }

    public function estudantes(Turma $turma)
    {
        $estudantes = $turma->estudantes;
        return view('estudantes.estudantes_da_turma', compact('turma', 'estudantes'));
    }
}
