@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mensalidades</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Mês de Referência</th>
                <th>Data de Vencimento</th>
                <th>Valor</th>
                <th>Forma de Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mensalidades as $mensalidade)
                <tr>
                    <td>{{ $mensalidade->estudante->nome ?? 'Desconhecido' }}</td>
                    <td>{{ $mensalidade->mes_referencia }}</td>
                    <td>{{ $mensalidade->data_vencimento }}</td>
                    <td>{{ number_format($mensalidade->valor, 2, ',', '.') }} MZN</td>
                    <td>{{ ucfirst($mensalidade->forma_pagamento) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
