<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EstudanteDashboardController;
use App\Http\Controllers\EstudanteController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProfessorDashboardController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\CoordenadorCursoController;
use App\Http\Controllers\CoordenadorEstagioController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\MensalidadeController;
use App\Http\Controllers\EstagioController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\ConfiguracaoSistemaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\FaturaController;
use App\Http\Controllers\AnoAcademicoController;

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin
Route::middleware(['auth', 'check.tipo:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/export/pdf', [AdminDashboardController::class, 'exportarPdf'])->name('admin.dashboard.export.pdf');
    Route::get('/dashboard/export/excel', [AdminDashboardController::class, 'exportarExcel'])->name('admin.dashboard.export.excel');

});

Route::middleware(['auth', 'check.tipo:admin'])->prefix('admin')->group(function () {
    Route::get('/estudantes', [EstudanteController::class, 'index'])->name('admin.estudantes.index');
    
});

Route::middleware(['auth', 'check.tipo:admin'])->prefix('admin')->group(function () {
    Route::get('/estudantes/export/pdf', [EstudanteController::class, 'exportPDF'])->name('estudantes.exportPdf');
    Route::get('/estudantes/export/excel', [App\Http\Controllers\EstudanteController::class, 'exportExcel'])->name('estudantes.exportExcel');
});

Route::middleware(['auth', 'check.tipo:admin'])->prefix('admin')->group(function () {
    Route::resource('professores', ProfessorController::class)->names('admin.professores');


    // Exportações (PDF / Excel)
 
    Route::get('professores/export/pdf', [ProfessorController::class, 'exportPDF'])->name('admin.professores.exportPdf');
    Route::get('professores/export/excel', [ProfessorController::class, 'exportExcel'])->name('admin.professores.exportExcel');
});



// Estudante
Route::middleware(['auth', 'check.tipo:estudante'])->prefix('estudante')->group(function () {
    Route::get('/dashboard', [EstudanteDashboardController::class, 'index'])->name('estudantes.dashboard');
    Route::get('/perfil', [EstudanteController::class, 'perfil'])->name('estudantes.perfil');
    Route::post('/perfil', [EstudanteController::class, 'atualizarPerfil'])->name('estudantes.perfil.atualizar');
    Route::get('/notas', [EstudanteController::class, 'notas'])->name('estudantes.notas');
    Route::get('/pagamentos', [EstudanteController::class, 'pagamentos'])->name('estudantes.pagamentos');
    Route::get('/faturas/{id}/visualizar', [FaturaController::class, 'visualizar'])->name('faturas.visualizar');
});

// Professor
Route::middleware(['auth', 'check.tipo:professor'])->prefix('professor')->group(function () {
    Route::get('/dashboard', [ProfessorDashboardController::class, 'index'])->name('professores.dashboard');
});

// Secretaria
Route::middleware(['auth', 'check.tipo:secretaria'])->prefix('secretaria')->group(function () {
    Route::get('/dashboard', [SecretariaController::class, 'dashboard'])->name('secretaria.dashboard');
});

// Coordenador de Curso
Route::middleware(['auth', 'check.tipo:coordenador_de_curso'])->prefix('coordenador')->group(function () {
    Route::get('/dashboard', [CoordenadorCursoController::class, 'index'])->name('coordenador_curso.dashboard');
});

// Coordenador de Estágio
Route::middleware(['auth', 'check.tipo:coordenador_estagio'])->prefix('coordenador-estagio')->group(function () {
    Route::get('/dashboard', [CoordenadorEstagioController::class, 'dashboard'])->name('coordenador_estagio.dashboard');
});

// Bibliotecário
Route::middleware(['auth', 'check.tipo:bibliotecario'])->prefix('biblioteca')->group(function () {
    Route::get('/dashboard', [BibliotecaController::class, 'dashboard'])->name('biblioteca.dashboard');
});

// Recursos gerais protegidos (para qualquer usuário autenticado)
Route::middleware(['auth'])->group(function () {
    Route::resources([
        'cursos' => CursoController::class,
        'estudantes' => EstudanteController::class,
        'professores' => ProfessorController::class,
        'turmas' => TurmaController::class,
        'matriculas' => MatriculaController::class,
        'mensalidades' => MensalidadeController::class,
        'estagios' => EstagioController::class,
        'livros' => LivroController::class,
        'emprestimos' => EmprestimoController::class,
        'configuracoes' => ConfiguracaoSistemaController::class,

    ]);

    // Pagamentos
    Route::post('/pagamentos/gerar', [PagamentoController::class, 'gerar'])->name('pagamentos.gerar');
    Route::get('/pagamentos/fatura/{id}', [PagamentoController::class, 'gerarFatura'])->name('pagamentos.fatura');
    Route::post('/api/notificacao-pagamento', [PagamentoController::class, 'receberNotificacao'])
        ->middleware('verificar.token.pagamento');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('ano-academicos', AnoAcademicoController::class);
});

use App\Http\Controllers\UsuarioController;

Route::middleware(['auth', 'check.tipo:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('usuarios', UsuarioController::class)->names('usuarios');
});



