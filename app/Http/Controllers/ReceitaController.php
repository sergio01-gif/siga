<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\Estudante;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function index()
    {
        $receitas = Receita::latest()->paginate(10);
        return view('receitas.index', compact('receitas'));
    }

    public function create()
    {
        $estudantes = Estudante::all();
        return view('receitas.create', compact('estudantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_recebimento' => 'required|date',
            'categoria' => 'nullable|string|max:255',
            'estudante_id' => 'nullable|exists:estudantes,id',
            'observacao' => 'nullable|string',
        ]);

        Receita::create($request->all());

        return redirect()->route('receitas.index')
            ->with('success', 'Receita adicionada com sucesso.');
    }

    public function edit(Receita $receita)
    {
        $estudantes = Estudante::all();
        return view('receitas.edit', compact('receita', 'estudantes'));
    }

    public function update(Request $request, Receita $receita)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_recebimento' => 'required|date',
            'categoria' => 'nullable|string|max:255',
            'estudante_id' => 'nullable|exists:estudantes,id',
            'observacao' => 'nullable|string',
        ]);

        $receita->update($request->all());

        return redirect()->route('receitas.index')
            ->with('success', 'Receita atualizada com sucesso.');
    }

    public function destroy(Receita $receita)
    {
        $receita->delete();

        return redirect()->route('receitas.index')
            ->with('success', 'Receita eliminada com sucesso.');
    }
}
