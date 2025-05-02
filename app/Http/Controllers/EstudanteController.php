<?php

namespace App\Http\Controllers;

use App\Models\Estudante;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\Factura;
use App\Models\Mensalidade;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EstudantesExport;
use Barryvdh\DomPDF\Facade\Pdf;

class EstudanteController extends Controller
{
    public function index(Request $request)
    {
        $cursoId = $request->curso_id;
        $turmaId = $request->turma_id;

        $estudantes = Estudante::with(['curso', 'turma'])
            ->when($cursoId, fn($query) => $query->where('curso_id', $cursoId))
            ->when($turmaId, fn($query) => $query->where('turma_id', $turmaId))
            ->get();

        $cursos = Curso::all();
        $turmas = Turma::all();

        return view('estudantes.index', compact('estudantes', 'cursos', 'turmas'));
    }

    public function create()
    {
        $cursos = Curso::all();
        $turmas = Turma::all();
        return view('estudantes.create', compact('cursos', 'turmas'));
    }

    public function store(Request $request)
    {
        $validador = Estudante::validar($request->all());

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        Estudante::create($request->all());

        return redirect()->route('estudantes.index')->with('success', 'Estudante cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $estudante = Estudante::findOrFail($id);
        $cursos = Curso::all();
        return view('estudantes.edit', compact('estudante', 'cursos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $estudante = Estudante::findOrFail($id);
        $estudante->update($request->all());

        return redirect()->route('estudantes.index')->with('success', 'Estudante atualizado com sucesso.');
    }

    public function show($id)
    {
        $estudante = Estudante::with(['curso', 'turma', 'mensalidades'])->findOrFail($id);
        $cursos = Curso::all();
        return view('estudantes.show', compact('estudante', 'cursos'));
    }

    public function exportExcel(Request $request)
    {
        $cursoId = $request->curso_id;
        $turmaId = $request->turma_id;

        $estudantes = Estudante::when($cursoId, fn($query) => $query->where('curso_id', $cursoId))
            ->when($turmaId, fn($query) => $query->where('turma_id', $turmaId))
            ->get();

        return Excel::download(new EstudantesExport($estudantes), 'estudantes.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $cursoId = $request->curso_id;
        $turmaId = $request->turma_id;
        $anoLectivo = $request->ano_lectivo;

        $estudantes = Estudante::with('curso')
            ->when($cursoId, fn($query) => $query->where('curso_id', $cursoId))
            ->when($turmaId, fn($query) => $query->where('turma_id', $turmaId))
            ->get();

        $curso = $cursoId ? Curso::find($cursoId) : null;
        $usuario = auth()->user();

        $pdf = Pdf::loadView('estudantes.pdf', [
            'estudantes' => $estudantes,
            'curso' => $curso,
            'anoLectivo' => $anoLectivo,
            'usuario' => $usuario
        ]);

        return $pdf->download('estudantes.pdf');
    }

    public function emitirFactura(Request $request, $estudanteId)
    {
        $estudante = Estudante::findOrFail($estudanteId);

        $mensalidade = Mensalidade::where('estudante_id', $estudanteId)
            ->where('status', 'pendente')
            ->first();

        if (!$mensalidade) {
            return redirect()->route('estudantes.index')->with('error', 'Não há mensalidade pendente para este estudante.');
        }

        $factura = Factura::create([
            'estudante_id' => $estudanteId,
            'valor' => $mensalidade->valor,
            'status' => 'pendente',
            'data_emissao' => now(),
            'mensalidade_id' => $mensalidade->id,
        ]);

        $mensalidade->update(['status' => 'faturada']);

        return redirect()->route('estudantes.index')->with('success', 'Fatura emitida com sucesso para o estudante.');
    }
}
