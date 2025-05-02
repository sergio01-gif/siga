<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudante;
use App\Models\Professor;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Obtendo o total de cursos, estudantes, professores e cursos concluídos
        $totalCursos = Curso::count();
        $totalEstudantes = Estudante::count();
        $totalProfessores = Professor::count();
        $cursosConcluidos = Curso::where('status', 'concluido')->count();

        // Obtendo dados para os gráficos
        $alunosPorCurso = Curso::withCount('estudantes')->get()->map(function ($curso) {
            return [
                'nome' => $curso->nome,
                'estudantes_count' => $curso->estudantes_count
            ];
        });

        // Obtendo os matriculados por ano
        $matriculadosPorAno = Matricula::selectRaw('YEAR(data_matricula) as ano, COUNT(*) as total')
            ->groupBy('ano')
            ->orderBy('ano')
            ->get()
            ->pluck('total');

        $anos = Matricula::selectRaw('YEAR(data_matricula) as ano')
            ->groupBy('ano')
            ->orderBy('ano')
            ->pluck('ano');

        // Retornando os dados para a view
        return view('admin.dashboard', compact(
            'totalCursos', 'totalEstudantes', 'totalProfessores', 'cursosConcluidos',
            'alunosPorCurso', 'matriculadosPorAno', 'anos'
        ));
    }
}
