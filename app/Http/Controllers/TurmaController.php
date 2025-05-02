<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Curso;
use App\Models\AnoAcademico;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    // Método para exibir todas as turmas
    public function index()
    {
        $turmas = Turma::all();
        return view('turmas.index', compact('turmas'));
    }

    // Método para exibir turmas por ano acadêmico
    public function turmasPorAno(AnoAcademico $anoAcademico)
    {
        $turmas = Turma::where('ano_academico_id', $anoAcademico->id)->get();

        return view('turmas.turmas_por_ano', compact('turmas', 'anoAcademico'));
    }

    // Método para exibir estudantes de uma turma
    public function estudantes(Turma $turma)
    {
        // Considerando que a Turma tem um relacionamento 'estudantes'
        $estudantes = $turma->estudantes;

        return view('estudantes.estudantes_da_turma', compact('turma', 'estudantes'));
    }

    // Método para exibir o formulário de criação de turma
    public function create()
    {
        // Recupera todos os cursos e anos acadêmicos
        $cursos = Curso::all();
        $anoAcademicos = AnoAcademico::all(); // Definindo a variável corretamente

        // Passa os dados para a view de criação de turma
        return view('turmas.create', compact('cursos', 'anoAcademicos'));
    }

    // Método para salvar uma nova turma no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'ano_academico_id' => 'required|exists:ano_academicos,id',
        ]);

        // Criação explícita da turma com os dados validados
        Turma::create([
            'nome' => $request->nome,
            'curso_id' => $request->curso_id,
            'ano_academico_id' => $request->ano_academico_id,
        ]);
        
        // Redireciona para a página de listagem de turmas com uma mensagem de sucesso
        return redirect()->route('turmas.index')->with('success', 'Turma criada com sucesso!');
    }

    // Método para exibir os detalhes de uma turma específica
    public function show(Turma $turma)
    {
        return view('turmas.show', compact('turma'));
    }

    // Método para exibir o formulário de edição de uma turma
    public function edit(Turma $turma)
    {
        // Recupera todos os cursos e anos acadêmicos
        $cursos = Curso::all();
        $anoAcademicos = AnoAcademico::all();

        // Passa os dados para a view de edição de turma
        return view('turmas.edit', compact('turma', 'cursos', 'anoAcademicos'));
    }

    // Método para atualizar os dados de uma turma
    public function update(Request $request, Turma $turma)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'ano_academico_id' => 'required|exists:ano_academicos,id',
        ]);

        // Atualiza os dados da turma com os dados enviados
        $turma->update([
            'nome' => $request->nome,
            'curso_id' => $request->curso_id,
            'ano_academico_id' => $request->ano_academico_id,
        ]);

        // Redireciona para a página de listagem de turmas com mensagem de sucesso
        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    // Método para excluir uma turma
    public function destroy(Turma $turma)
    {
        // Exclui a turma do banco de dados
        $turma->delete();

        // Redireciona para a página de listagem de turmas com mensagem de sucesso
        return redirect()->route('turmas.index')->with('success', 'Turma excluída com sucesso!');
    }
}
