<?php

namespace App\Http\Controllers;

use App\Models\Estudante;
use App\Models\Mensalidade;
use Illuminate\Http\Request;

class MensalidadeController extends Controller
{
    public function create()
    {
        $estudantes = Estudante::all();
        return view('mensalidades.create', compact('estudantes'));
    }

    public function index()
{
    $mensalidades = Mensalidade::with('estudante')->orderBy('data_vencimento', 'desc')->get();
    return view('mensalidades.index', compact('mensalidades'));
}


    public function store(Request $request)
{
    $request->validate([
        'estudante_id' => 'required|exists:estudantes,id',
        'mes_referencia' => 'required|string',
        'data_vencimento' => 'required|date',
        'valor' => 'required|numeric|min:0',
        'forma_pagamento' => 'required|in:dinheiro,mpesa,emola,cartao,transferencia,entidade_referencia',
        'entidade_referencia' => 'nullable|string',
    ]);

    $mensalidade = new Mensalidade();
    $mensalidade->estudante_id = $request->estudante_id;
    $mensalidade->mes_referencia = $request->mes_referencia;
    $mensalidade->data_vencimento = $request->data_vencimento;
    $mensalidade->valor = $request->valor;
    $mensalidade->forma_pagamento = $request->forma_pagamento;

    if ($request->forma_pagamento === 'entidade_referencia') {
        $mensalidade->entidade_referencia = $request->entidade_referencia;
    }

    $mensalidade->save();

    return redirect()->route('mensalidades.index')->with('success', 'Mensalidade registrada com sucesso.');
}

}
