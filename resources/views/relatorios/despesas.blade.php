@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório de Despesas</h1>

    <table class="table table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Pagamento</th>
                <th>Forma</th>
                <th>Categoria</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($despesas as $despesa)
                <tr>
                    <td>{{ $despesa->descricao }}</td>
                    <td>{{ number_format($despesa->valor, 2, ',', '.') }} MT</td>
                    <td>{{ $despesa->data_pagamento_formatada }}</td>
                    <td>{{ $despesa->forma_pagamento }}</td>
                    <td>{{ $despesa->categoria->nome ?? '—' }}</td>
                    <td>
                        <span class="badge bg-{{ $despesa->status == 'pago' ? 'success' : 'warning' }}">
                            {{ ucfirst($despesa->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('relatorios.gerarPdfDespesas') }}" class="btn btn-primary mt-3">Baixar PDF</a>
</div>
@endsection
