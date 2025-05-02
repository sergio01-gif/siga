<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Avaliacao;
use App\Models\Estudante;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function index()
    {
        $notas = Nota::with('avaliacao', 'estudante')->get();
        return view('notas.index', compact('notas'));
    }

    public function create()
    {
        $avaliacoes = Avaliacao::all();
        $estudantes = Estudante::all();
        return view('notas.create', compact('avaliacoes', 'estudantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'avaliacao_id' => 'required',
            'estudante_id' => 'required',
            'nota' => 'required|numeric|min:0|max:20',
            'observacao' => 'nullable|string',
        ]);

        Nota::create($request->all());

        return redirect()->route('notas.index')->with('success', 'Nota lançada com sucesso.');
    }

    public function edit(Nota $nota)
    {
        $avaliacoes = Avaliacao::all();
        $estudantes = Estudante::all();
        return view('notas.edit', compact('nota', 'avaliacoes', 'estudantes'));
    }

    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            'avaliacao_id' => 'required',
            'estudante_id' => 'required',
            'nota' => 'required|numeric|min:0|max:20',
            'observacao' => 'nullable|string',
        ]);

        $nota->update($request->all());

        return redirect()->route('notas.index')->with('success', 'Nota atualizada com sucesso.');
    }

    public function destroy(Nota $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index')->with('success', 'Nota excluída com sucesso.');
    }
}
