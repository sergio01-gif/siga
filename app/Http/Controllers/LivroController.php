<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::latest()->paginate(10);
        return view('biblioteca.livros.index', compact('livros'));
    }

    public function create()
    {
        return view('biblioteca.livros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'codigo_exemplar' => 'required|unique:livros,codigo_exemplar',
            'quantidade_total' => 'required|integer|min:1',
        ]);

        Livro::create(array_merge(
            $request->all(),
            ['quantidade_disponivel' => $request->quantidade_total]
        ));

        return redirect()->route('livros.index')->with('success', 'Livro cadastrado com sucesso.');
    }

    public function show(Livro $livro)
    {
        return view('biblioteca.livros.show', compact('livro'));
    }

    public function edit(Livro $livro)
    {
        return view('biblioteca.livros.edit', compact('livro'));
    }

    public function update(Request $request, Livro $livro)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'codigo_exemplar' => 'required|unique:livros,codigo_exemplar,' . $livro->id,
            'quantidade_total' => 'required|integer|min:1',
        ]);

        $livro->update($request->all());

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso.');
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();
        return redirect()->route('livros.index')->with('success', 'Livro removido com sucesso.');
    }
}
