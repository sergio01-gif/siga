@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório de Receitas</h1>

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

    <a href="{{ route('relatorios.gerarPdfReceitas') }}" class="btn btn-primary">Baixar PDF</a>
</div>
@endsection
