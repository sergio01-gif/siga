<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Estudante;
use App\Models\Turma;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::all();
        return view('matriculas.index', compact('matriculas'));
    }

    public function create()
    {
        $estudantes = Estudante::all();
        $turmas = Turma::all();
        return view('matriculas.create', compact('estudantes', 'turmas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudante_id' => 'required|exists:estudantes,id',
            'turma_id' => 'required|exists:turmas,id',
        ]);

        Matricula::create($request->all());
        return redirect()->route('matriculas.index');
    }

    public function show(Matricula $matricula)
    {
        return view('matriculas.show', compact('matricula'));
    }

    public function edit(Matricula $matricula)
    {
        return view('matriculas.edit', compact('matricula'));
    }

    public function update(Request $request, Matricula $matricula)
    {
        $request->validate([
            'estudante_id' => 'required|exists:estudantes,id',
            'turma_id' => 'required|exists:turmas,id',
        ]);

        $matricula->update($request->all());
        return redirect()->route('matriculas.index');
    }

    public function destroy(Matricula $matricula)
    {
        $matricula->delete();
        return redirect()->route('matriculas.index');
    }
}
