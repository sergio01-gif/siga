<?php

namespace App\Http\Controllers;

use App\Models\CategoriaLivro;
use Illuminate\Http\Request;

class CategoriaLivroController extends Controller
{
    // Exibe a lista de categorias de livros
    public function index()
    {
        $categorias = CategoriaLivro::all();
        return view('categorias_livros.index', compact('categorias'));
    }

    // Exibe o formulário para criar uma nova categoria de livro
    public function create()
    {
        return view('categorias_livros.create');
    }

    // Salva a nova categoria no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        CategoriaLivro::create($request->all());

        return redirect()->route('categorias-livros.index');
    }

    // Exibe o formulário de edição de categoria de livro
    public function edit(CategoriaLivro $categoriaLivro)
    {
        return view('categorias_livros.edit', compact('categoriaLivro'));
    }

    // Atualiza uma categoria de livro
    public function update(Request $request, CategoriaLivro $categoriaLivro)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $categoriaLivro->update($request->all());

        return redirect()->route('categorias-livros.index');
    }

    // Exclui uma categoria de livro
    public function destroy(CategoriaLivro $categoriaLivro)
    {
        $categoriaLivro->delete();

        return redirect()->route('categorias-livros.index');
    }
}
