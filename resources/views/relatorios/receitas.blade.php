@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório de Receitas</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Data</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Estudante</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receitas as $receita)
                <tr>
                    <!-- Exibindo a data de recebimento -->
                    <td>
                        @if($receita->data_recebimento instanceof \Carbon\Carbon)
                            {{ $receita->data_recebimento->format('d/m/Y') }}
                        @else
                            {{ $receita->data_recebimento }}
                        @endif
                    </td>

                    <!-- Exibindo a categoria -->
                    <td>{{ $receita->categoria ? $receita->categoria->nome : 'Sem Categoria' }}</td>

                    <!-- Exibindo a descrição -->
                    <td>{{ $receita->descricao }}</td>

                    <!-- Exibindo o valor formatado -->
                    <td>{{ number_format($receita->valor, 2, ',', '.') }} MT</td>

                    <!-- Exibindo o nome do estudante -->
                    <td>{{ $receita->estudante ? $receita->estudante->nome : 'Sem Estudante' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('relatorios.gerarPdfReceitas') }}" class="btn btn-primary">Baixar PDF</a>
</div>
@endsection
