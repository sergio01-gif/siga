<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;
use App\Models\Estudante;
use App\Models\Professor;
use App\Models\AnoAcademico;
use App\Models\Matricula;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Totais reais (ou você pode ajustar conforme necessário)
        $totalCursos = Curso::count();
        $totalEstudantes = Estudante::count();
        $totalProfessores = Professor::count();
        $cursosConcluidos = Curso::where('duracao', '<=', now()->year)->count(); // exemplo

        // Dados para gráficos (personalize conforme sua lógica real)
        $cursosLabels = Curso::pluck('nome')->toArray(); // Certifique-se de que é um array
        $cursosData = Curso::withCount('estudantes')->get()->pluck('estudantes_count')->toArray(); // Converter para array

        $anosLabels = AnoAcademico::selectRaw("CONCAT(ano_inicio, '-', ano_fim) as ano_completo")->pluck('ano_completo')->toArray();
        $matriculasData = AnoAcademico::withCount('matriculas')->get()->pluck('matriculas_count')->toArray();

        // Buscar os últimos 5 anúncios reais do banco de dados
        //$anuncios = Anuncio::latest()->take(5)->get();

        return view('dashboard', compact(
            'user',
            'totalCursos',
            'totalEstudantes',
            'totalProfessores',
            'cursosConcluidos',
            'cursosLabels',
            'cursosData',
            'anosLabels',
            'matriculasData',
           // 'anuncios'
        ));
    }
}
