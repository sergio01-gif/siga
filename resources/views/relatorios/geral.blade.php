@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório Geral</h1>

    <h2>Receitas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Recebimento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receitas as $receita)
                <tr>
                    <td>{{ $receita->descricao }}</td>
                    <td>{{ number_format($receita->valor, 2, ',', '.') }} MT</td>
                    <td>{{ $receita->data_recebimento->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Despesas</h2>
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

    <a href="{{ route('relatorios.gerarPdfGeral') }}" class="btn btn-primary">Baixar PDF</a>
</div>
@endsection
