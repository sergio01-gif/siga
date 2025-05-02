@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório de Despesas</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($despesas as $despesa)
                <tr>
                    <td>{{ $despesa->descricao }}</td>
                    <td>{{ number_format($despesa->valor, 2, ',', '.') }} MT</td>
                    <td>{{ $despesa->data_pagamento->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('relatorios.gerarPdfDespesas') }}" class="btn btn-primary">Baixar PDF</a>
</div>
@endsection
