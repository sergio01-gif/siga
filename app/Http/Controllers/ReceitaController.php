<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\Estudante;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    // Exibe a lista de receitas com paginação
    public function index()
    {
        // Recupera as receitas com paginação de 10 por página, carregando a categoria e estudante relacionados
        $receitas = Receita::with('categoria', 'estudante')->paginate(10);
        
        // Retorna a view com as receitas paginadas
        return view('receitas.index', compact('receitas'));
    }

    // Exibe o formulário para criar uma nova receita
    public function create()
    {
        // Recupera todos os estudantes para o campo de seleção
        $estudantes = Estudante::all();

        // Retorna a view para criar uma nova receita
        return view('receitas.create', compact('estudantes'));
    }

    // Armazena a nova receita no banco de dados
    public function store(Request $request)
    {
        // Valida os dados recebidos do formulário
        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_recebimento' => 'required|date',
            'categoria_id' => 'nullable|exists:categorias,id', // A categoria agora deve ser selecionada pelo ID
            'estudante_id' => 'nullable|exists:estudantes,id',
            'observacao' => 'nullable|string',
        ]);

        // Cria a receita no banco de dados
        Receita::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_recebimento' => $request->data_recebimento,
            'categoria_id' => $request->categoria_id,
            'estudante_id' => $request->estudante_id,
            'observacao' => $request->observacao,
        ]);

        // Redireciona para a página de listagem de receitas com uma mensagem de sucesso
        return redirect()->route('receitas.index')
            ->with('success', 'Receita adicionada com sucesso.');
    }

    // Exibe o formulário para editar uma receita existente
    public function edit(Receita $receita)
    {
        // Recupera todos os estudantes para o campo de seleção
        $estudantes = Estudante::all();

        // Retorna a view para editar a receita, passando a receita e os estudantes
        return view('receitas.edit', compact('receita', 'estudantes'));
    }

    // Atualiza a receita no banco de dados
    public function update(Request $request, Receita $receita)
    {
        // Valida os dados recebidos do formulário
        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_recebimento' => 'required|date',
            'categoria_id' => 'nullable|exists:categorias,id',
            'estudante_id' => 'nullable|exists:estudantes,id',
            'observacao' => 'nullable|string',
        ]);

        // Atualiza a receita com os novos dados
        $receita->update([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_recebimento' => $request->data_recebimento,
            'categoria_id' => $request->categoria_id,
            'estudante_id' => $request->estudante_id,
            'observacao' => $request->observacao,
        ]);

        // Redireciona para a página de listagem de receitas com uma mensagem de sucesso
        return redirect()->route('receitas.index')
            ->with('success', 'Receita atualizada com sucesso.');
    }

    // Exclui uma receita do banco de dados
    public function destroy(Receita $receita)
    {
        // Exclui a receita
        $receita->delete();

        // Redireciona para a página de listagem de receitas com uma mensagem de sucesso
        return redirect()->route('receitas.index')
            ->with('success', 'Receita eliminada com sucesso.');
    }
}
