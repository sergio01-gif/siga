<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudante;
use App\Models\Professor;
use App\Models\Matricula;
use App\Models\Estagio;
use App\Models\Factura;
use App\Models\Livro;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EstudantesExport;
use App\Models\Mensalidade;  // Adicionar o modelo de Mensalidade
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();  // Obter o usuário autenticado

        // Dados gerais
        $totalCursos = Curso::count();
        $totalEstudantes = Estudante::count();
        $totalProfessores = Professor::count();
        $totalEstagios = Estagio::count();
        $totalFaturas = Factura::count();
        $totalLivros = Livro::count();

        // Cálculo de mensalidades
        $totalMensalidades = Mensalidade::count();
        $mensalidadesPagas = Mensalidade::where('status', 'pago')->count();
        $mensalidadesDevidas = Mensalidade::where('status', 'devido')->count();
        $dividaTotal = Mensalidade::where('status', 'devido')->sum('valor');  // Total de dívida pendente

        // Variáveis para cada papel de usuário
        $cursosCoordenados = 0;
        $matriculasTotal = 0;
        $alunosSobSupervisao = 0;
        $estagiosAtivos = 0;
        $cursosInscritos = 0;
        $livrosDisponiveis = 0;

        if ($user->role == 'coordenador_de_curso') {
            // Cursos sob coordenação
            $cursosCoordenados = Curso::where('coordenador_id', $user->id)->count();
        }

        if ($user->role == 'registro_academico') {
            // Total de matrículas
            $matriculasTotal = Matricula::count();
        }

        if ($user->role == 'professor') {
            // Alunos sob supervisão do professor
            $alunosSobSupervisao = Estudante::where('supervisor_id', $user->id)->count();
        }

        if ($user->role == 'coordenador_estagio') {
            // Estágios ativos
            $estagiosAtivos = Estagio::where('status', 'ativo')->count();
        }

        if ($user->role == 'estudante') {
            // Cursos inscritos por estudante
            $cursosInscritos = Matricula::where('estudante_id', $user->id)->count();
        }

        if ($user->role == 'bibliotecario') {
            // Livros disponíveis na biblioteca
            $livrosDisponiveis = Livro::where('status', 'disponivel')->count();
        }

        // Retornar a view com as variáveis
        return view('dashboard', compact(
            'totalCursos', 'totalEstudantes', 'totalProfessores', 'totalEstagios', 'totalFaturas', 'totalLivros',
            'totalMensalidades', 'mensalidadesPagas', 'mensalidadesDevidas', 'dividaTotal',
            'cursosCoordenados', 'matriculasTotal', 'alunosSobSupervisao', 'estagiosAtivos', 'cursosInscritos', 'livrosDisponiveis'
        ));
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
}
