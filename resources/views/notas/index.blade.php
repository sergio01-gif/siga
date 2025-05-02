@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Notas</h1>
    <a href="{{ route('notas.create') }}" class="btn btn-primary">Adicionar Nota</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Avaliacao</th>
                <th>Estudante</th>
                <th>Nota</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notas as $nota)
            <tr>
                <td>{{ $nota->avaliacao->nome }}</td>
                <td>{{ $nota->estudante->nome }}</td>
                <td>{{ $nota->nota }}</td>
                <td>{{ $nota->observacao }}</td>
                <td>
                    <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('notas.destroy', $nota->id) }}" method="POST" style="display:inline;">
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
