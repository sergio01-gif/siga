<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Estudante;
use App\Models\Turma;
use App\Models\AnoAcademico;
use App\Models\Curso;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::with(['estudante', 'turma', 'curso'])->get();
        return view('matriculas.index', compact('matriculas'));
    }

    public function create()
    {
        $estudantes = Estudante::all();
        $turmas = Turma::with('anoAcademico')->get();
        $anosAcademicos = AnoAcademico::all();
        $cursos = Curso::all();

        return view('matriculas.create', compact('estudantes', 'turmas', 'anosAcademicos', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudante_id' => 'required|exists:estudantes,id',
            'turma_id' => 'required|exists:turmas,id',
            'ano_academico_id' => 'required|exists:ano_academicos,id',
            'curso_id' => 'required|exists:cursos,id',
            'data_matricula' => 'required|date',
            'estado' => 'required|in:ativo,inativo',
        ]);

        Matricula::create([
            'estudante_id' => $request->estudante_id,
            'turma_id' => $request->turma_id,
            'ano_academico_id' => $request->ano_academico_id,
            'curso_id' => $request->curso_id,
            'data_matricula' => $request->data_matricula,
            'estado' => $request->estado,
        ]);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula criada com sucesso!');
    }

    public function show(Matricula $matricula)
    {
        // Carrega estudante, turma e ano acadêmico
        $matricula->load(['estudante', 'turma.anoAcademico', 'curso']);
    
        return view('matriculas.show', compact('matricula'));
    }
    
    public function edit(Matricula $matricula)
    {
        $estudantes = Estudante::all();
        $turmas = Turma::with('anoAcademico')->get();
        $anosAcademicos = AnoAcademico::all();
        $cursos = Curso::all();

        return view('matriculas.edit', compact('matricula', 'estudantes', 'turmas', 'anosAcademicos', 'cursos'));
    }

    public function update(Request $request, Matricula $matricula)
    {
        $request->validate([
            'estudante_id' => 'required|exists:estudantes,id',
            'turma_id' => 'required|exists:turmas,id',
            'ano_academico_id' => 'required|exists:ano_academicos,id',
            'curso_id' => 'required|exists:cursos,id',
            'data_matricula' => 'required|date',
            'estado' => 'required|in:ativo,inativo',
        ]);

        $matricula->update([
            'estudante_id' => $request->estudante_id,
            'turma_id' => $request->turma_id,
            'ano_academico_id' => $request->ano_academico_id,
            'curso_id' => $request->curso_id,
            'data_matricula' => $request->data_matricula,
            'estado' => $request->estado,
        ]);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula atualizada com sucesso!');
    }

    public function destroy(Matricula $matricula)
    {
        $matricula->delete();
        return redirect()->route('matriculas.index')->with('success', 'Matrícula removida com sucesso!');
    }
}
