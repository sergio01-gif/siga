<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Pagamento;
use App\Models\Mensalidade;

class PagamentoController extends Controller
{
    public function criarPagamento(Request $request)
    {
        $request->validate([
            'mensalidade_id' => 'required|exists:mensalidades,id',
            'metodo' => 'required|in:mpesa,emola,banco'
        ]);

        $mensalidade = Mensalidade::findOrFail($request->mensalidade_id);
        $estudante = Auth::user();

        // Entidades fixas por método
        $entidades = [
            'mpesa' => '856123',
            'emola' => '857456',
            'banco' => '999001'
        ];

        $entidade = $entidades[$request->metodo];
        $referencia = strtoupper(Str::random(10)); // Pode ser substituída por um gerador formal

        $pagamento = Pagamento::create([
            'estudante_id' => $estudante->id,
            'mensalidade_id' => $mensalidade->id,
            'metodo' => $request->metodo,
            'entidade' => $entidade,
            'referencia' => $referencia,
            'valor' => $mensalidade->valor,
            'estado' => 'pendente',
        ]);

        return response()->json([
            'success' => true,
            'mensagem' => 'Pagamento iniciado com sucesso.',
            'pagamento' => $pagamento
        ]);
    }

    public function receberNotificacao(Request $request)
{
    $request->validate([
        'referencia' => 'required|string',
        'estado' => 'required|in:pago,falhado',
        'valor' => 'required|numeric',
        'data_pagamento' => 'required|date',
    ]);

    $pagamento = Pagamento::where('referencia', $request->referencia)->first();

    if (!$pagamento) {
        return response()->json(['success' => false, 'mensagem' => 'Pagamento não encontrado.'], 404);
    }

    $pagamento->update([
        'estado' => $request->estado,
        'data_pagamento' => $request->data_pagamento,
    ]);

    // Atualiza mensalidade se o estado for pago
    if ($request->estado === 'pago') {
        $pagamento->mensalidade->update(['estado' => 'pago']);
    }

    return response()->json(['success' => true, 'mensagem' => 'Pagamento atualizado com sucesso.']);
}

public function gerar(Request $request)
{
    $request->validate([
        'mensalidade_id' => 'required|exists:mensalidades,id',
        'metodo' => 'required|in:mpesa,emola,banco'
    ]);

    $mensalidade = Mensalidade::findOrFail($request->mensalidade_id);
    $estudante = Auth::user();

    // Entidades fixas por método
    $entidades = [
        'mpesa' => '856123',
        'emola' => '857456',
        'banco' => '999001'
    ];

    $entidade = $entidades[$request->metodo];
    $referencia = strtoupper(Str::random(10));

    $pagamento = Pagamento::create([
        'estudante_id' => $estudante->id,
        'mensalidade_id' => $mensalidade->id,
        'metodo' => $request->metodo,
        'entidade' => $entidade,
        'referencia' => $referencia,
        'valor' => $mensalidade->valor,
        'estado' => 'pendente',
    ]);

    return redirect()->back()->with('success', 'Pagamento gerado com sucesso. Entidade: ' . $entidade . ' | Referência: ' . $referencia . ' | Valor: ' . number_format($mensalidade->valor, 2) . ' MZN');
}

public function gerarFatura($id)
{
    $pagamento = Pagamento::with(['mensalidade', 'estudante'])->findOrFail($id);

    if ($pagamento->estado !== 'pago') {
        return redirect()->back()->with('error', 'Pagamento ainda não confirmado.');
    }

    $config = \App\Models\ConfiguracaoSistema::first();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pagamentos.fatura', compact('pagamento', 'config'))
        ->setPaper('A4', 'portrait');

    return $pdf->download('fatura_' . $pagamento->referencia . '.pdf');
}



}
