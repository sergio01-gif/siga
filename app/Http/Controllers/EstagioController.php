<?php

namespace App\Http\Controllers;

use App\Models\Estagio;
use App\Models\Estudante;
use Illuminate\Http\Request;

class EstagioController extends Controller
{
    public function index()
    {
        $estagios = Estagio::with('estudante')->latest()->paginate(10);
        return view('estagios.index', compact('estagios'));
    }

    public function create()
    {
        $estudantes = Estudante::all();
        return view('estagios.create', compact('estudantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudante_id' => 'required|exists:estudantes,id',
            'empresa' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'orientador' => 'nullable|string|max:255'
        ]);

        Estagio::create($request->all());

        return redirect()->route('estagios.index')->with('success', 'Estágio registrado com sucesso.');
    }

    public function edit(Estagio $estagio)
    {
        $estudantes = Estudante::all();
        return view('estagios.edit', compact('estagio', 'estudantes'));
    }

    public function update(Request $request, Estagio $estagio)
    {
        $request->validate([
            'estudante_id' => 'required|exists:estudantes,id',
            'empresa' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'orientador' => 'nullable|string|max:255',
            'status' => 'required|in:em_andamento,concluido,cancelado'
        ]);

        $estagio->update($request->all());

        return redirect()->route('estagios.index')->with('success', 'Estágio atualizado com sucesso.');
    }

    public function destroy(Estagio $estagio)
    {
        $estagio->delete();
        return redirect()->route('estagios.index')->with('success', 'Estágio removido com sucesso.');
    }
}
