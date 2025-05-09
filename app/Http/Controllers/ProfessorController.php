<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Cadeira;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProfessoresExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfessorController extends Controller
{
    // Listar todos os professores
    public function index(Request $request)
{
    $especialidade = $request->especialidade;
    $tipo = $request->tipo_contratacao;

    $professores = \App\Models\Professor::with('usuario')
        ->when($especialidade, fn($q) => $q->where('especialidade', 'like', "%$especialidade%"))
        ->when($tipo, fn($q) => $q->where('tipo_contratacao', $tipo))
        ->latest()
        ->paginate(10);

    return view('admin.professores.index', compact('professores', 'especialidade', 'tipo'));
}


    // Formulário de criação
    public function create()
    {
        $usuarios = Usuario::all();
        $cadeiras = Cadeira::all();
        return view('professores.create', compact('usuarios', 'cadeiras'));
    }

    // Armazenar novo professor
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

    // Visualizar um professor
    public function show(Professor $professor)
    {
        return view('professores.show', compact('professor'));
    }

    // Formulário de edição
    public function edit(Professor $professor)
    {
        $usuarios = Usuario::select('id', 'nome')->get();
        return view('professores.edit', compact('professor', 'usuarios'));
    }

    // Atualizar dados do professor
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
            // Apagar a foto antiga
            if ($professor->foto && Storage::disk('public')->exists($professor->foto)) {
                Storage::disk('public')->delete($professor->foto);
            }
            $data['foto'] = $request->file('foto')->store('professores', 'public');
        }

        $professor->update($data);

        return redirect()->route('professores.index')->with('success', 'Professor atualizado com sucesso!');
    }

    // Excluir professor
    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);

        // Excluir foto se existir
        if ($professor->foto && Storage::disk('public')->exists($professor->foto)) {
            Storage::disk('public')->delete($professor->foto);
        }

        $professor->delete();

        return redirect()->route('professores.index')->with('success', 'Professor excluído com sucesso!');
    }

    // Imprimir dados do professor
    public function imprimir($id)
    {
        $professor = Professor::with('cadeiras')->findOrFail($id);
        return view('professores.impressao', compact('professor'));
    }

    // Dashboard do professor
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $usuario = Auth::user();

        if ($usuario->tipo_usuario !== 'professor') {
            Auth::logout();
            return redirect()->route('login')->withErrors(['message' => 'Acesso não autorizado.']);
        }

        $professor = $usuario->professor()->with('cadeiras')->first();

        if (!$professor) {
            return redirect()->route('login')->withErrors(['message' => 'Conta de professor não encontrada.']);
        }

        return view('professores.dashboard', compact('professor'));
    }

    // Página de notas do professor
    public function notas()
    {
        return view('professores.notas'); // Criar esta view
    }

    public function exportExcel()
{
    return Excel::download(new ProfessoresExport, 'professores.xlsx');
}

public function exportPDF()
{
    $professores = \App\Models\Professor::all();
    $config = \App\Models\ConfiguracaoSistema::first();
    $usuario = auth()->user();
    $dataExportacao = now()->format('d/m/Y H:i');

    $pdf = Pdf::loadView('professores.exports.pdf', compact('professores', 'config', 'usuario', 'dataExportacao'));
    return $pdf->download('professores.pdf');
}

}
