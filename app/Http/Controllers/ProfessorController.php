<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Cadeira;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProfessorController extends Controller
{
    public function index()
    {
        $professores = Professor::with(['usuario', 'cadeiras'])->paginate(10);
        return view('professores.index', compact('professores'));
    }
    

    public function create()
    {
        $usuarios = Usuario::all();
    $cadeiras = Cadeira::all(); // ← ESSA LINHA é necessária

    return view('professores.create', compact('usuarios', 'cadeiras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:professores,email',
            'telefone' => 'required|string|max:20',
            'documento_identificacao' => 'required|string|max:50',
            'tipo_contratacao' => 'required|string|max:50',
            'especialidade' => 'required|string|max:100',
            'usuario_id' => 'required|exists:usuarios,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('professores', 'public');
        }

        Professor::create($data);

        return redirect()->route('professores.index')->with('success', 'Professor criado com sucesso!');
    }

    public function show(Professor $professor)
    {
        return view('professores.show', compact('professor'));
    }

    public function edit(Professor $professor)
    {
        $usuarios = Usuario::select('id', 'nome')->get();
        return view('professores.edit', compact('professor', 'usuarios'));
    }

    public function update(Request $request, Professor $professor)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:professores,email,' . $professor->id,
            'telefone' => 'required|string|max:20',
            'documento_identificacao' => 'required|string|max:50',
            'tipo_contratacao' => 'required|string|max:50',
            'especialidade' => 'required|string|max:100',
            'usuario_id' => 'required|exists:usuarios,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Apagar a foto antiga, se existir
            if ($professor->foto && Storage::disk('public')->exists($professor->foto)) {
                Storage::disk('public')->delete($professor->foto);
            }
            $data['foto'] = $request->file('foto')->store('professores', 'public');
        }

        $professor->update($data);

        return redirect()->route('professores.index')->with('success', 'Professor atualizado com sucesso!');
    }

    public function destroy($id)
{
    $professor = Professor::findOrFail($id); // Encontra o professor
    $professor->delete(); // Deleta o professor

    return redirect()->route('professores.index')->with('success', 'Professor excluído com sucesso!');
}

// ProfessorController.php

public function imprimir($id)
{
    $professor = Professor::with('cadeiras')->findOrFail($id);
    
    return view('professores.impressao', compact('professor'));
}


}
