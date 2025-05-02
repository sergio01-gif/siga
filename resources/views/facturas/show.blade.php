@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes da Fatura</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Número da Fatura:</strong> {{ $factura->numero_factura }}</p>
            <p><strong>Nome do Estudante:</strong> {{ $factura->estudante->nome }}</p>
            <p><strong>Valor Pago:</strong> {{ number_format($factura->valor_pago, 2, ',', '.') }} MZN</p>
            <p><strong>Data:</strong> {{ $factura->created_at->format('d/m/Y') }}</p>

            <a href="{{ route('facturas.pdf', $factura->id) }}" class="btn btn-primary" target="_blank">
                Gerar PDF
            </a>
        </div>
    </div>

    <a href="{{ route('facturas.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
