<?php
namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function index()
    {
        $anuncios = Anuncio::latest()->get();
        return view('anuncios.index', compact('anuncios'));
    }

    public function create()
    {
        return view('anuncios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'destinatarios' => 'required|in:todos,estudantes,professores',
            'data_publicacao' => 'required|date',
        ]);

        Anuncio::create($request->all());

        return redirect()->route('anuncios.index')->with('success', 'Anúncio criado com sucesso!');
    }


    public function edit(Anuncio $anuncio)
    {
        return view('anuncios.edit', compact('anuncio'));
    }

    public function update(Request $request, Anuncio $anuncio)
    {
        $request->validate([
            'titulo' => 'required',
            'conteudo' => 'required',
            'destinatarios' => 'required',
        ]);

        $anuncio->update($request->all());

        return redirect()->route('anuncios.index')->with('success', 'Anúncio atualizado.');
    }

    public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();
        return back()->with('success', 'Anúncio removido.');
    }
}
