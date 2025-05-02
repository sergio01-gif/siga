<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Categoria;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::with(['autor', 'categoria'])->get();
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        $autores = Autor::all();
        $categorias = Categoria::all();
        return view('livros.create', compact('autores', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'autor_id' => 'required',
            'categoria_id' => 'required',
            'data_publicacao' => 'required|date',
            'quantidade' => 'required|integer',
        ]);
        
        Livro::create($request->all());
        return redirect()->route('livros.index');
    }

    public function edit(Livro $livro)
    {
        $autores = Autor::all();
        $categorias = Categoria::all();
        return view('livros.edit', compact('livro', 'autores', 'categorias'));
    }

    public function update(Request $request, Livro $livro)
    {
        $request->validate([
            'titulo' => 'required',
            'autor_id' => 'required',
            'categoria_id' => 'required',
            'data_publicacao' => 'required|date',
            'quantidade' => 'required|integer',
        ]);

        $livro->update($request->all());
        return redirect()->route('livros.index');
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();
        return redirect()->route('livros.index');
    }
}
