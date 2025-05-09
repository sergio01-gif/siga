@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Receitas</h2>

    <!-- Verifica se existe uma mensagem de sucesso -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Recebimento</th>
                <th>Categoria</th>
                <th>Estudante</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receitas as $receita)
                <tr>
                    <td>{{ $receita->descricao }}</td>
                    <td>{{ number_format($receita->valor, 2, ',', '.') }} MT</td>
                    <td>{{ \Carbon\Carbon::parse($receita->data_recebimento)->format('d/m/Y') }}</td>
                    <td>{{ $receita->categoria ? $receita->categoria->nome : 'Sem categoria' }}</td>
                    <td>{{ $receita->estudante ? $receita->estudante->nome : 'Nenhum estudante' }}</td>
                    <td>
                        <!-- Botões de ação: Editar e Excluir -->
                        <a href="{{ route('receitas.edit', $receita->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('receitas.destroy', $receita->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta receita?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="d-flex justify-content-center">
        {{ $receitas->links() }}
    </div>

    <!-- Botão para adicionar uma nova receita -->
    <a href="{{ route('receitas.create') }}" class="btn btn-primary mt-3">Adicionar Receita</a>
</div>
@endsection
