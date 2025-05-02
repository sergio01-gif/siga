<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course; // Certifica se o nome do modelo é esse
use App\Models\Enrollment; // Modelo de matrícula
use App\Models\Notice;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Contagem de alunos e professores
        $totalAlunos = User::where('role', 'aluno')->count();
        $totalProfessores = User::where('role', 'professor')->count();

        // Total de cursos
        $totalCursos = Course::count();

        // Cursos concluídos (exemplo: assumindo que há uma coluna 'status' no curso ou matrícula)
        $cursosConcluidos = Course::where('status', 'concluido')->count();

        // Alunos por curso
        $alunosPorCurso = Course::withCount('students')->get(); 
        // Relacionamento no modelo Course: public function students() { return $this->belongsToMany(User::class, 'enrollments'); }

        // Evolução de matriculados por ano
        $matriculados = Enrollment::selectRaw('YEAR(created_at) as ano, COUNT(*) as total')
            ->groupBy('ano')
            ->orderBy('ano')
            ->get();

        $anos = $matriculados->pluck('ano');
        $matriculadosPorAno = $matriculados->pluck('total');

        // Lista de cursos
        $courses = Course::all();

        return view('admin.dashboard', compact(
            'totalAlunos',
            'totalProfessores',
            'totalCursos',
            'cursosConcluidos',
            'alunosPorCurso',
            'anos',
            'matriculadosPorAno',
            'courses'
        ));
    }
}
