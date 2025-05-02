<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Professores;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\Professor;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalCursos = Course::count();
        $totalAlunos = Student::count();
        $totalProfessores = Professor::count();
        $cursosConcluidos = Course::where('status', 'concluido')->count();

        // Alunos por curso (para gráfico)
        $alunosPorCurso = Course::withCount('students')->get();

        // Corrigir aqui: trazer todos cursos para a tabela
        $courses = Course::all();

        return view('admin.dashboard', compact(
            'totalCursos',
            'totalAlunos',
            'totalProfessores',
            'cursosConcluidos',
            'alunosPorCurso',
            'courses' // adiciona isso
        ));
    }
}
