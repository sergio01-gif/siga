<?php

namespace App\Http\Controllers;

use App\Models\Estudante;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\AnoAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Exports\EstudantesExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pagamento;

class EstudanteController extends Controller
{
    public function index(Request $request)
    {
        $anoId = $request->ano_lectivo_id;
        $cursoId = $request->curso_id;
        $turmaId = $request->turma_id;

        $estudantes = Estudante::with(['curso', 'turma', 'ano_lectivo'])
            ->when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))
            ->when($cursoId, fn($q) => $q->where('curso_id', $cursoId))
            ->when($turmaId, fn($q) => $q->where('turma_id', $turmaId))
            ->paginate(10);

        $anos = AnoAcademico::all();
        $cursos = Curso::all();
        $turmas = Turma::all();

        return view('estudantes.index', compact('estudantes', 'anos', 'cursos', 'turmas', 'anoId', 'cursoId', 'turmaId'));
    }

    public function create()
    {
        $anos = AnoAcademico::all();
        $cursos = Curso::all();
        $turmas = Turma::all();

        return view('estudantes.create', compact('anos', 'cursos', 'turmas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|unique:estudantes,email',
            'telefone' => 'required|string|unique:estudantes,telefone',
            'data_nascimento' => 'nullable|date',
            'genero' => 'nullable|in:masculino,feminino,outro',
            'morada' => 'nullable|string',
            'tipo_documento' => 'nullable|in:BI,Passaporte,DIRE,Outro',
            'numero_documento' => 'nullable|string|max:100',
            'curso_id' => 'nullable|exists:cursos,id',
            'turma_id' => 'nullable|exists:turmas,id',
            'ano_lectivo_id' => 'nullable|exists:anos_academicos,id',
            'estado' => 'required|in:ativo,suspenso,transferido',
            'foto' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Estudante::create($data);

        return redirect()->route('estudantes.index')->with('success', 'Estudante cadastrado com sucesso.');
    }

    public function edit(Estudante $estudante)
    {
        $anos = AnoAcademico::all();
        $cursos = Curso::all();
        $turmas = Turma::all();

        return view('estudantes.edit', compact('estudante', 'anos', 'cursos', 'turmas'));
    }

    public function update(Request $request, Estudante $estudante)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|unique:estudantes,email,' . $estudante->id,
            'telefone' => 'required|string|unique:estudantes,telefone,' . $estudante->id,
            'data_nascimento' => 'nullable|date',
            'genero' => 'nullable|in:masculino,feminino,outro',
            'morada' => 'nullable|string',
            'tipo_documento' => 'nullable|in:BI,Passaporte,DIRE,Outro',
            'numero_documento' => 'nullable|string|max:100',
            'curso_id' => 'nullable|exists:cursos,id',
            'turma_id' => 'nullable|exists:turmas,id',
            'ano_lectivo_id' => 'nullable|exists:anos_academicos,id',
            'estado' => 'required|in:ativo,suspenso,transferido',
            'foto' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $estudante->update($data);

        return redirect()->route('estudantes.index')->with('success', 'Estudante atualizado com sucesso.');
    }

    public function destroy(Estudante $estudante)
    {
        $estudante->delete();
        return redirect()->route('estudantes.index')->with('success', 'Estudante removido com sucesso.');
    }

    public function perfil()
    {
        $estudante = Auth::user();
        return view('estudantes.perfil', compact('estudante'));
    }

    public function atualizarPerfil(Request $request)
    {
        $estudante = Auth::user();

        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $estudante->update([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
        ]);

        return redirect()->route('estudante.perfil')->with('success', 'Perfil atualizado com sucesso.');
    }


    public function exportExcel(Request $request)
    {
        $cursoId = $request->curso_id;
        $turmaId = $request->turma_id;

        $estudantes = Estudante::with(['curso', 'turma', 'ano_lectivo'])
            ->when($cursoId, fn($q) => $q->where('curso_id', $cursoId))
            ->when($turmaId, fn($q) => $q->where('turma_id', $turmaId))
            ->get();

        $config = \App\Models\ConfiguracaoSistema::first();
        $curso = Curso::find($cursoId);
        $turma = Turma::find($turmaId);
        $usuario = Auth::user();

        return Excel::download(new EstudantesExport($estudantes, $config, $curso, $turma, $usuario), 'estudantes.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $cursoId = $request->curso_id;
        $turmaId = $request->turma_id;

        $estudantes = Estudante::with(['curso', 'turma', 'ano_lectivo'])
            ->when($cursoId, fn($q) => $q->where('curso_id', $cursoId))
            ->when($turmaId, fn($q) => $q->where('turma_id', $turmaId))
            ->get();

        $config = \App\Models\ConfiguracaoSistema::first();
        $curso = Curso::find($cursoId);
        $turma = Turma::find($turmaId);
        $usuario = Auth::user();
        $dataExportacao = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('estudantes.exports.pdf', compact('estudantes', 'config', 'curso', 'turma', 'usuario', 'dataExportacao'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('estudantes.pdf');
    }

    public function pagamentos()
{
    $estudante = Auth::user();

    $pagamentos = Pagamento::where('estudante_id', $estudante->id)
        ->with('mensalidade')
        ->latest()
        ->take(10)
        ->get();

    return view('estudantes.pagamentos', compact('pagamentos'));
}

}




