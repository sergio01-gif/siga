<?php

namespace App\Http\Controllers;

use App\Models\Cadeira;
use App\Models\Curso;
use Illuminate\Http\Request;

class CadeiraController extends Controller
{
    // Lista todas as cadeiras
    public function index()
    {
        $cadeiras = Cadeira::with('cursos')->paginate(10);
        return view('cadeiras.index', compact('cadeiras'));
    }

    // Mostra o formulário de criação
    public function create()
    {
        $cursos = Curso::all(); // Para escolher cursos associados
        return view('cadeiras.create', compact('cursos'));
    }

    // Armazena uma nova cadeira
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'carga_horaria' => 'required|numeric',
            'semestre' => 'required|string|max:10',
            'descricao' => 'nullable|string',
            'estado' => 'required|in:ativo,inativo',
            'curso_id' => 'required|array',
            'curso_id.*' => 'exists:cursos,id',
        ]);
    
        $cadeira = new Cadeira();
        $cadeira->nome = $validated['nome'];
        $cadeira->carga_horaria = $validated['carga_horaria'];
        $cadeira->semestre = $validated['semestre'];
        $cadeira->descricao = $validated['descricao'] ?? null;
        $cadeira->estado = $validated['estado'];
        $cadeira->save();
    
        // Relacionar com os cursos
        $cadeira->cursos()->sync($validated['curso_id']);
    
        return redirect()->route('cadeiras.index')->with('success', 'Cadeira criada com sucesso.');
    }
    


    // Mostra o formulário de edição
    public function edit($id)
    {
        $cadeira = Cadeira::findOrFail($id);
        $cursos = Curso::all();
        $selectedCursos = $cadeira->cursos->pluck('id')->toArray();

        return view('cadeiras.edit', compact('cadeira', 'cursos', 'selectedCursos'));
    }

    // Atualiza a cadeira
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'carga_horaria' => 'required|numeric',
            'semestre' => 'required|string|max:10',
            'descricao' => 'nullable|string',
            'estado' => 'required|in:ativo,inativo',
            'curso_ids' => 'required|array',
            'curso_ids.*' => 'exists:cursos,id',
        ]);

        $cadeira = Cadeira::findOrFail($id);

        $cadeira->update([
            'nome' => $validated['nome'],
            'carga_horaria' => $validated['carga_horaria'],
            'semestre' => $validated['semestre'],
            'descricao' => $validated['descricao'] ?? null,
            'estado' => $validated['estado'],
        ]);

        $cadeira->cursos()->sync($validated['curso_ids']);

        return redirect()->route('cadeiras.index')->with('success', 'Cadeira atualizada com sucesso.');
    }

    // Remove a cadeira
    public function destroy($id)
    {
        $cadeira = Cadeira::findOrFail($id);
        $cadeira->cursos()->detach(); // Remove relacionamentos
        $cadeira->delete(); // Remove a cadeira

        return redirect()->route('cadeiras.index')->with('success', 'Cadeira removida com sucesso.');
    }
}
