<?php

namespace App\Http\Controllers;

use App\Models\Mensalidade;
use App\Models\Estudante;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class MensalidadeController extends Controller
{
    public function index(Request $request)
    {
        $query = Mensalidade::with('estudante');

        if ($request->filled('mes')) {
            $query->where('mes_referencia', $request->mes);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('estudante_id')) {
            $query->where('estudante_id', $request->estudante_id);
        }

        $mensalidades = $query->latest()->paginate(10);

        return view('mensalidades.index', compact('mensalidades'));
    }

    public function create()
    {
        $estudantes = Estudante::all();
        $meses = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        return view('mensalidades.create', compact('estudantes', 'meses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudante_id' => 'required|exists:estudantes,id',
            'mes_referencia' => [
                'required',
                Rule::unique('mensalidades')->where(function ($query) use ($request) {
                    return $query->where('estudante_id', $request->estudante_id)
                                 ->where('mes_referencia', $request->mes_referencia);
                })
            ],
            'valor' => 'required|numeric|min:0',
        ]);

        Mensalidade::create([
            'estudante_id' => $request->estudante_id,
            'mes_referencia' => $request->mes_referencia,
            'valor' => $request->valor,
            'estado' => 'pendente',
        ]);

        return redirect()->route('mensalidades.index')->with('success', 'Mensalidade criada com sucesso.');
    }

    public function show(Mensalidade $mensalidade)
    {
        return view('mensalidades.show', compact('mensalidade'));
    }

    public function edit(Mensalidade $mensalidade)
    {
        $estudantes = Estudante::all();
        $meses = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        return view('mensalidades.edit', compact('mensalidade', 'estudantes', 'meses'));
    }

    public function update(Request $request, Mensalidade $mensalidade)
    {
        $request->validate([
            'estudante_id' => 'required|exists:estudantes,id',
            'mes_referencia' => 'required',
            'valor' => 'required|numeric|min:0',
        ]);

        $mensalidade->update($request->only(['estudante_id', 'mes_referencia', 'valor']));

        return redirect()->route('mensalidades.index')->with('success', 'Mensalidade atualizada com sucesso.');
    }

    public function destroy(Mensalidade $mensalidade)
    {
        $mensalidade->delete();
        return redirect()->route('mensalidades.index')->with('success', 'Mensalidade removida com sucesso.');
    }

    public function marcarComoPago(Mensalidade $mensalidade)
    {
        $mensalidade->update(['estado' => 'pago', 'data_pagamento' => Carbon::now()]);
        return redirect()->back()->with('success', 'Mensalidade marcada como paga.');
    }
}
