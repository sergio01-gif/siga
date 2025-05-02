<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    public function index()
    {
        $despesas = Despesa::latest()->paginate(10);
        return view('despesas.index', compact('despesas'));
    }

    public function create()
    {
        return view('despesas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data_pagamento' => 'required|date',
            'categoria' => 'nullable|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        Despesa::create($request->all());

        return redirect()->route('despesas.index')->with('success', 'Despesa registrada com sucesso!');
    }

    public function edit(Despesa $despesa)
    {
        return view('despesas.edit', compact('despesa'));
    }

    public function update(Request $request, Despesa $despesa)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data_pagamento' => 'required|date',
            'categoria' => 'nullable|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        $despesa->update($request->all());

        return redirect()->route('despesas.index')->with('success', 'Despesa atualizada com sucesso!');
    }

    public function destroy(Despesa $despesa)
    {
        $despesa->delete();

        return redirect()->route('despesas.index')->with('success', 'Despesa eliminada com sucesso!');
    }
}
