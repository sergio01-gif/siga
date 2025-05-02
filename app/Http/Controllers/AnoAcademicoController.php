<?php

namespace App\Http\Controllers;

use App\Models\AnoAcademico;
use Illuminate\Http\Request;

class AnoAcademicoController extends Controller
{
    /**
     * Exibe a lista de anos acadêmicos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtém todos os anos acadêmicos
        $anoAcademicos = AnoAcademico::all();

        // Passa a variável 'anoAcademicos' para a view
        return view('ano_academicos.index', compact('anoAcademicos'));
    }

    /**
     * Exibe o formulário para criar um novo ano acadêmico.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('ano_academicos.create');
    }

    /**
     * Armazena um novo ano acadêmico no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos
        $request->validate([
            'ano_inicio' => 'required|integer',
            'ano_fim' => 'required|integer',
        ]);

        // Cria um novo ano acadêmico no banco de dados
        AnoAcademico::create($request->all());

        // Redireciona para a página de listagem de anos acadêmicos
        return redirect()->route('ano_academicos.index');
    }

    /**
     * Exibe os detalhes de um ano acadêmico específico.
     *
     * @param  \App\Models\AnoAcademico  $ano
     * @return \Illuminate\View\View
     */
    public function show(AnoAcademico $ano)
    {
        return view('ano_academicos.show', compact('ano'));
    }

    /**
     * Exibe o formulário para editar um ano acadêmico específico.
     *
     * @param  \App\Models\AnoAcademico  $ano
     * @return \Illuminate\View\View
     */
    public function edit(AnoAcademico $ano)
    {
        return view('ano_academicos.edit', compact('ano'));
    }

    /**
     * Atualiza os dados de um ano acadêmico específico no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnoAcademico  $ano
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, AnoAcademico $ano)
    {
        // Valida os dados recebidos
        $request->validate([
            'ano_inicio' => 'required|integer',
            'ano_fim' => 'required|integer',
        ]);

        // Atualiza o ano acadêmico no banco de dados
        $ano->update($request->all());

        // Redireciona para a página de listagem de anos acadêmicos
        return redirect()->route('ano_academicos.index');
    }

    /**
     * Exclui um ano acadêmico específico do banco de dados.
     *
     * @param  \App\Models\AnoAcademico  $ano
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AnoAcademico $ano)
    {
        // Exclui o ano acadêmico do banco de dados
        $ano->delete();

        // Redireciona para a página de listagem de anos acadêmicos
        return redirect()->route('ano_academicos.index');
    }
}
