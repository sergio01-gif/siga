<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => 'required|string|unique:cursos,codigo',
            'duracao' => 'required|integer|min:1',
            'descricao' => 'nullable|string',
            'status' => 'required|string|in:ativo,inativo',
            'coordenador_id' => 'nullable|exists:professores,id',
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso.');
    }

    public function show(Curso $curso)
    {
        return view('cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => 'required|string|unique:cursos,codigo,' . $curso->id,
            'duracao' => 'required|integer|min:1',
            'descricao' => 'nullable|string',
            'status' => 'required|string|in:ativo,inativo',
            'coordenador_id' => 'nullable|exists:professores,id',
        ]);

        $curso->update($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Curso excluído com sucesso.');
    }
}
