@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Avaliações</h1>
    <a href="{{ route('avaliacoes.create') }}" class="btn btn-primary">Adicionar Avaliação</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cadeira</th>
                <th>Turma</th>
                <th>Data da Avaliação</th>
                <th>Peso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($avaliacoes as $avaliacao)
            <tr>
                <td>{{ $avaliacao->nome }}</td>
                <td>{{ $avaliacao->cadeira->nome }}</td>
                <td>{{ $avaliacao->turma->nome }}</td>
                <td>{{ $avaliacao->data_avaliacao->format('d/m/Y') }}</td>
                <td>{{ $avaliacao->peso }}</td>
                <td>
                    <a href="{{ route('avaliacoes.edit', $avaliacao->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('avaliacoes.destroy', $avaliacao->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
