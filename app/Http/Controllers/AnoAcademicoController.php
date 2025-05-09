<?php

namespace App\Http\Controllers;

use App\Models\AnoAcademico;
use Illuminate\Http\Request;

class AnoAcademicoController extends Controller
{
    public function index()
    {
        $anoAcademicos = AnoAcademico::orderByDesc('inicio')->get();
        return view('ano_academicos.index', compact('anoAcademicos'));
    }

    public function create()
    {
        return view('ano_academicos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:anos_academicos,nome',
            'inicio' => 'required|date',
            'fim' => 'required|date|after:inicio',
        ]);

        AnoAcademico::create($request->only('nome', 'inicio', 'fim'));

        return redirect()->route('ano-academicos.index')->with('success', 'Ano acadêmico criado com sucesso.');
    }

    public function edit(AnoAcademico $anoAcademico)
    {
        return view('ano_academicos.edit', compact('anoAcademico'));
    }

    public function update(Request $request, AnoAcademico $anoAcademico)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:anos_academicos,nome,' . $anoAcademico->id,
            'inicio' => 'required|date',
            'fim' => 'required|date|after:inicio',
        ]);

        $anoAcademico->update($request->only('nome', 'inicio', 'fim'));

        return redirect()->route('ano-academicos.index')->with('success', 'Ano acadêmico atualizado com sucesso.');
    }

    public function destroy(AnoAcademico $anoAcademico)
    {
        $anoAcademico->delete();
        return redirect()->route('ano-academicos.index')->with('success', 'Ano acadêmico removido com sucesso.');
    }
}
