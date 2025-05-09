<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Estudante;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::with(['livro', 'estudante'])->latest()->paginate(10);
        return view('biblioteca.emprestimos.index', compact('emprestimos'));
    }

    public function create()
    {
        $livros = Livro::where('quantidade_disponivel', '>', 0)->get();
        $estudantes = Estudante::all();
        return view('biblioteca.emprestimos.create', compact('livros', 'estudantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'estudante_id' => 'required|exists:estudantes,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao_prevista' => 'required|date|after_or_equal:data_emprestimo'
        ]);

        $emprestimo = Emprestimo::create($request->all());

        $emprestimo->livro->decrement('quantidade_disponivel');

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo registrado com sucesso.');
    }

    public function devolver(Emprestimo $emprestimo)
    {
        $emprestimo->update([
            'data_devolucao_real' => now(),
            'estado' => 'devolvido'
        ]);

        $emprestimo->livro->increment('quantidade_disponivel');

        return redirect()->back()->with('success', 'Livro devolvido com sucesso.');
    }

    public function destroy(Emprestimo $emprestimo)
    {
        $emprestimo->delete();
        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo removido.');
    }
}
