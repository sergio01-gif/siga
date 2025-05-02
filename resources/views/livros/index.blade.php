@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Livros</h1>
        <a href="{{ route('livros.create') }}" class="btn btn-primary">Adicionar Livro</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livros as $livro)
                    <tr>
                        <td>{{ $livro->titulo }}</td>
                        <td>{{ $livro->autor }}</td>
                        <td>{{ $livro->editora }}</td>
                        <td>
                            <a href="{{ route('livros.show', $livro) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('livros.edit', $livro) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('livros.destroy', $livro) }}" method="POST" style="display: inline;">
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
