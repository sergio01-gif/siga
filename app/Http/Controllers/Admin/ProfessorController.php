<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Professores;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfessorController extends Controller
{
    public function index()
    {
        $professors = Professor::latest()->paginate(10);
        return view('admin.professors.index', compact('professors'));
    }

    public function create()
    {
        return view('admin.professors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'genero' => 'required|string',
            'morada' => 'nullable|string',
            'documento_identificacao' => 'nullable|string',
            'tipo_contratacao' => 'required|string',
            'especialidade' => 'nullable|string',
            'estado' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Upload da foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos_professores', 'public');
        }

        // Criação do usuário
        $user = User::create([
            'name' => $validated['nome'],
            'email' => $validated['email'],
            'telefone' => $validated['telefone'],
            'password' => Hash::make('12345678'), // Senha padrão (altere conforme necessário)
            'tipo' => 'professor', // Certifique-se de que este campo existe
        ]);

        // Criação do professor com vínculo ao usuário
        $validated['user_id'] = $user->id;
        Professor::create($validated);

        return redirect()->route('admin.professors.index')->with('success', 'Professor e usuário criados com sucesso.');
    }

    public function edit($id)
    {
        $professor = Professor::findOrFail($id);
        return view('admin.professors.edit', compact('professor'));
    }

    public function update(Request $request, $id)
    {
        $professor = Professor::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $professor->user_id,
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'genero' => 'required|string',
            'morada' => 'nullable|string',
            'documento_identificacao' => 'nullable|string',
            'tipo_contratacao' => 'required|string',
            'especialidade' => 'nullable|string',
            'estado' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Atualizar a foto, se necessário
        if ($request->hasFile('foto')) {
            if ($professor->foto && Storage::disk('public')->exists($professor->foto)) {
                Storage::disk('public')->delete($professor->foto);
            }

            $validated['foto'] = $request->file('foto')->store('fotos_professores', 'public');
        }

        // Atualizar dados do professor
        $professor->update($validated);

        // Atualizar dados do usuário
        if ($professor->user) {
            $professor->user->update([
                'name' => $validated['nome'],
                'email' => $validated['email'],
                'telefone' => $validated['telefone'],
            ]);
        }

        return redirect()->route('admin.professors.index')->with('success', 'Professor e usuário atualizados com sucesso.');
    }

    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);

        if ($professor->foto && Storage::disk('public')->exists($professor->foto)) {
            Storage::disk('public')->delete($professor->foto);
        }

        // Deleta também o usuário vinculado, se necessário
        if ($professor->user) {
            $professor->user->delete();
        }

        $professor->delete();

        return redirect()->route('admin.professors.index')->with('success', 'Professor e usuário removidos com sucesso.');
    }
}
