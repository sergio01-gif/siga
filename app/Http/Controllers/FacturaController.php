<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Estudante;
use App\Models\Mensalidade;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FacturaController extends Controller
{
    // Lista todas as faturas
    public function index()
    {
        $facturas = Factura::with('estudante', 'mensalidade')->latest()->paginate(10);
        return view('facturas.index', compact('facturas'));
    }

    // Formulário para criar nova fatura
    public function create(Request $request)
{
    $estudantes = Estudante::all();
    $estudanteSelecionado = $request->query('estudante_id');

    $mensalidades = Mensalidade::where('status', 'pendente')->get();

    return view('facturas.create', compact('estudantes', 'mensalidades', 'estudanteSelecionado'));
}

    // Armazena nova fatura no banco
    public function store(Request $request)
    {
        $request->validate([
            'mensalidade_id' => 'required|exists:mensalidades,id',
            'estudante_id' => 'required|exists:estudantes,id',
            'valor_pago' => 'required|numeric|min:0',
            'data_pagamento' => 'required|date',
            'forma_pagamento' => 'required|string|max:255',
        ]);

        $numeroFactura = 'FAC-' . strtoupper(Str::random(6)) . '-' . now()->format('Ymd');

        $factura = Factura::create([
            'numero_factura' => $numeroFactura,
            'mensalidade_id' => $request->mensalidade_id,
            'estudante_id' => $request->estudante_id,
            'valor_pago' => $request->valor_pago,
            'data_pagamento' => $request->data_pagamento,
            'forma_pagamento' => $request->forma_pagamento,
            'observacoes' => $request->observacoes,
        ]);

        // Atualiza o status da mensalidade como paga
        $mensalidade = Mensalidade::find($request->mensalidade_id);
        $mensalidade->status = 'paga';
        $mensalidade->save();

        return redirect()->route('facturas.index')->with('success', 'Fatura emitida com sucesso.');
    }

    // Exibe uma fatura específica
    public function show(Factura $factura)
    {
        return view('facturas.show', compact('factura'));
    }

    // Formulário de edição (opcional)
    public function edit(Factura $factura)
    {
        $estudantes = Estudante::all();
        $mensalidades = Mensalidade::all();
        return view('facturas.edit', compact('factura', 'estudantes', 'mensalidades'));
    }

    // Atualiza uma fatura (opcional)
    public function update(Request $request, Factura $factura)
    {
        $request->validate([
            'valor_pago' => 'required|numeric|min:0',
            'data_pagamento' => 'required|date',
            'forma_pagamento' => 'required|string|max:255',
        ]);

        $factura->update($request->all());

        return redirect()->route('facturas.index')->with('success', 'Fatura atualizada com sucesso.');
    }

    // Remove uma fatura
    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect()->route('facturas.index')->with('success', 'Fatura excluída.');
    }

    use PDF;

public function exportarPdf(Factura $factura)
{
    $pdf = PDF::loadView('facturas.pdf', compact('factura'));
    return $pdf->download('factura_' . $factura->numero_factura . '.pdf');
}

}
