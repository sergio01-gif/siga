@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Receitas</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('receitas.create') }}" class="btn btn-primary mb-3">Adicionar Receita</a>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Descrição</th>
                <th>Valor (MZN)</th>
                <th>Data de Recebimento</th>
                <th>Categoria</th>
                <th>Estudante</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receitas as $receita)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $receita->descricao }}</td>
                    <td>{{ number_format($receita->valor, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($receita->data_recebimento)->format('d/m/Y') }}</td>
                    <td>{{ $receita->categoria ?? '-' }}</td>
                    <td>{{ $receita->estudante->nome ?? '-' }}</td>
                    <td>{{ $receita->observacao ?? '-' }}</td>
                    <td>
                        <a href="{{ route('receitas.edit', $receita->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('receitas.destroy', $receita->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tens certeza que queres eliminar?')">Eliminar</button>
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
</div>
@endsection
