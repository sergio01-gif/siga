<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\EstudanteController;
use App\Http\Controllers\MensalidadeController;
use App\Http\Controllers\TurmaController;

// Recursos do sistema (CRUD)
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AnoAcademicoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\CadeiraController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CategoriaLivroController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\AnuncioController;

// Página pública inicial
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Auth::routes(['reset' => true]);


// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil do usuário
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Relatórios em PDF
    Route::prefix('relatorios')->name('relatorios.')->group(function () {
        Route::get('/receitas/pdf', [RelatorioController::class, 'gerarPdfReceitas'])->name('gerarPdfReceitas');
        Route::get('/despesas/pdf', [RelatorioController::class, 'gerarPdfDespesas'])->name('gerarPdfDespesas');
        Route::get('/receitas', [RelatorioController::class, 'receitas'])->name('receitas');
        Route::get('/despesas', [RelatorioController::class, 'despesas'])->name('despesas');
        Route::get('/geral', [RelatorioController::class, 'geral'])->name('geral');
    });

    // Facturas
    Route::prefix('facturas')->name('facturas.')->group(function () {
        Route::get('/create', [FacturaController::class, 'create'])->name('create');
        Route::get('/{factura}/pdf', [FacturaController::class, 'exportarPdf'])->name('pdf');
    });
    Route::resource('facturas', FacturaController::class)->except(['create']);

    // Exportações de estudantes
    Route::prefix('estudantes')->name('estudantes.')->group(function () {
        Route::get('/export-excel', [EstudanteController::class, 'exportExcel'])->name('exportExcel');
        Route::get('/export-pdf', [EstudanteController::class, 'exportPDF'])->name('exportPDF');
    });

    // Recursos CRUD
    Route::resources([
        'usuarios'            => UsuarioController::class,
        'ano_academicos'      => AnoAcademicoController::class,
        'anoAcademicos'      => AnoAcademicoController::class,
        'cursos'              => CursoController::class,
        'turmas'              => TurmaController::class,
        'estudantes'          => EstudanteController::class,
        'professores'         => ProfessorController::class,
        'matriculas'          => MatriculaController::class,
        'cadeiras'            => CadeiraController::class,
        'receitas'            => ReceitaController::class,
        'despesas'            => DespesaController::class,
        'categorias'          => CategoriaController::class,
        'categoriaslivro'     => CategoriaLivroController::class,
        'categorias-livros'   => CategoriaLivroController::class,
        'livros'              => LivroController::class,
        'avaliacoes'          => AvaliacaoController::class,
        'notas'               => NotaController::class,
        'anuncios'            => AnuncioController::class,
        'mensalidades'        => MensalidadeController::class,
        
    ]);
    Route::resource('cadeiras', CadeiraController::class);
    Route::post('/turmas', [TurmaController::class, 'store'])->name('turmas.store');


    // Mensalidades
    Route::post('mensalidades/{mensalidade}/pagar', [MensalidadeController::class, 'pagar'])->name('mensalidades.pagar');
    Route::get('/mensalidades/create', [MensalidadeController::class, 'create'])->name('mensalidades.create');

    // Turmas por Ano Acadêmico
    Route::get('ano-academicos/{anoAcademico}/turmas', [TurmaController::class, 'turmasPorAno'])->name('ano_academicos.turmas');

    // Estudantes de uma Turma
    Route::get('/turmas/{turma}/estudantes', [TurmaController::class, 'estudantes'])->name('turmas.estudantes');

    // Criar professor (rota extra se necessário)
    Route::get('/professores/create', [ProfessorController::class, 'create'])->name('professors.create');

    
    Route::post('/estudantes/{id}/emitir-factura', [EstudanteController::class, 'emitirFactura'])->name('estudantes.emitirFactura');
    // routes/web.php

Route::get('estudantes/{id}/edit', [EstudanteController::class, 'edit'])->name('estudantes.edit');

Route::get('estudantes/{id}', [EstudanteController::class, 'show'])->name('estudantes.show');

Route::get('/professores/{professor}/disciplinas', [ProfessorController::class, 'disciplinas'])->name('professores.disciplinas');
Route::post('/professores/{professor}/disciplinas', [ProfessorController::class, 'atribuirDisciplinas'])->name('professores.atribuirDisciplinas');

// Rota para criar um novo professor
Route::get('/professores/create', [ProfessorController::class, 'create'])->name('professores.create');
Route::delete('/professores/{id}', [ProfessorController::class, 'destroy'])->name('professores.destroy');
// Rota para imprimir a lista de professores
Route::get('/professores/imprimir', [ProfessorController::class, 'imprimir'])->name('professores.imprimir');





});
