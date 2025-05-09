<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudante;
use App\Models\Professor;
use App\Models\Livro;
use App\Models\Estagio;
use App\Models\Mensalidade;
use App\Models\Factura;
use Illuminate\Http\Request;
use App\Models\AnoAcademico;
use App\Exports\DashboardExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class AdminDashboardController extends Controller
{


public function index(Request $request)
{
    $anoId = $request->input('ano_id') ?? null;

    $anos = AnoAcademico::orderBy('nome', 'desc')->get();

    // Filtro para estudantes, professores e outros por ano
    $totalEstudantes = Estudante::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->count();
    $totalProfessores = Professor::count();
    $totalCursos = Curso::count();
    $totalLivros = Livro::count();
    $totalEstagios = Estagio::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->count();

    $estudantesPorCurso = Curso::with(['estudantes' => function ($q) use ($anoId) {
        if ($anoId) $q->where('ano_lectivo_id', $anoId);
    }])
    ->get()
    ->mapWithKeys(fn($curso) => [$curso->nome => $curso->estudantes->count()]);

    $mensalidadesPagas = Mensalidade::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->where('estado', 'pago')->count();
    $mensalidadesPendentes = Mensalidade::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->where('estado', 'pendente')->count();

    return view('admin.dashboard', compact(
        'anos',
        'anoId',
        'totalEstudantes',
        'totalProfessores',
        'totalCursos',
        'totalLivros',
        'totalEstagios',
        'estudantesPorCurso',
        'mensalidadesPagas',
        'mensalidadesPendentes'
    ));
}


public function exportExcel(Request $request)
{
    $anoId = $request->input('ano_id');

    $dados = [/* mesmos dados do dashboard filtrados */];

    return Excel::download(new DashboardExport($dados), 'dashboard.xlsx');
}

public function exportPDF(Request $request)
{
    $anoId = $request->input('ano_id');

    $dados = [/* mesmos dados do dashboard filtrados */];

    $pdf = Pdf::loadView('admin.dashboard', compact('dados'));
    return $pdf->download('dashboard.pdf');
}



public function exportarPdf(Request $request)
{
    $anoId = $request->input('ano');

    // Obtenha os dados do dashboard (os mesmos usados na view normal)
    $totalCursos = Curso::count();
    $totalEstudantes = Estudante::count();
    $totalProfessores = Professor::count();
    $totalEstagios = Estagio::count();
    $totalFaturas = Factura::count();
    $totalLivros = Livro::count();

    $totalMensalidades = Mensalidade::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->count();
    $mensalidadesPagas = Mensalidade::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->where('estado', 'pago')->count();
    $mensalidadesPendentes = Mensalidade::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->where('estado', 'pendente')->count();

    $pdf = Pdf::loadView('admin.dashboard_pdf', compact(
        'totalCursos',
        'totalEstudantes',
        'totalProfessores',
        'totalEstagios',
        'totalFaturas',
        'totalLivros',
        'totalMensalidades',
        'mensalidadesPagas',
        'mensalidadesPendentes'
    ));

    return $pdf->download('dashboard_admin.pdf');
}

public function exportarExcel(Request $request)
{
    $anoId = $request->input('ano');

    // Dados do dashboard
    $dados = [
        'totalCursos' => Curso::count(),
        'totalEstudantes' => Estudante::count(),
        'totalProfessores' => Professor::count(),
        'totalEstagios' => Estagio::count(),
        'totalFaturas' => Factura::count(),
        'totalLivros' => Livro::count(),
        'totalMensalidades' => Mensalidade::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->count(),
        'mensalidadesPagas' => Mensalidade::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->where('estado', 'pago')->count(),
        'mensalidadesPendentes' => Mensalidade::when($anoId, fn($q) => $q->where('ano_lectivo_id', $anoId))->where('estado', 'pendente')->count(),
    ];

    return Excel::download(new DashboardExport($dados), 'dashboard_admin.xlsx');
}



}
