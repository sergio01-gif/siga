<?php

namespace App\Http\Controllers\Admin;

use App\Models\Turma;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnoAcademico;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::all();
        return view('admin.turmas.index', compact('turmas'));
    }

    public function create()
    {
        return view('admin.turmas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date',
        ]);

        Turma::create($request->all());

        return redirect()->route('admin.turmas.index')->with('success', 'Turma criada com sucesso!');
    }

    public function edit(Turma $turma)
    {
        return view('admin.turmas.edit', compact('turma'));
    }

    public function update(Request $request, Turma $turma)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date',
        ]);

        $turma->update($request->all());

        return redirect()->route('admin.turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy(Turma $turma)
    {
        $turma->delete();

        return redirect()->route('admin.turmas.index')->with('success', 'Turma excluída com sucesso!');
    }
    public function turmasPorAno(AnoAcademico $anoAcademico)
{
    $turmas = Turma::where('ano_academico_id', $anoAcademico->id)->get();

    return view('turmas.turmas_por_ano', compact('turmas', 'anoAcademico'));
}
}
