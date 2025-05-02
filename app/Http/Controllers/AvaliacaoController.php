<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Cadeira;
use App\Models\Turma;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $avaliacoes = Avaliacao::with('cadeira', 'turma')->get();
        return view('avaliacoes.index', compact('avaliacoes'));
    }

    public function create()
    {
        $cadeiras = Cadeira::all();
        $turmas = Turma::all();
        return view('avaliacoes.create', compact('cadeiras', 'turmas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cadeira_id' => 'required',
            'turma_id' => 'required',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_avaliacao' => 'required|date',
            'peso' => 'required|numeric',
        ]);

        Avaliacao::create($request->all());

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação criada com sucesso.');
    }

    public function edit(Avaliacao $avaliacao)
    {
        $cadeiras = Cadeira::all();
        $turmas = Turma::all();
        return view('avaliacoes.edit', compact('avaliacao', 'cadeiras', 'turmas'));
    }

    public function update(Request $request, Avaliacao $avaliacao)
    {
        $request->validate([
            'cadeira_id' => 'required',
            'turma_id' => 'required',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_avaliacao' => 'required|date',
            'peso' => 'required|numeric',
        ]);

        $avaliacao->update($request->all());

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação atualizada com sucesso.');
    }

    public function destroy(Avaliacao $avaliacao)
    {
        $avaliacao->delete();
        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação excluída com sucesso.');
    }
}
