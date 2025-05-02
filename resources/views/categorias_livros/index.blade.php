@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista de Categorias de Livros</h2>
        <a href="{{ route('categorias-livros.create') }}" class="btn btn-primary">Adicionar Categoria</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nome }}</td>
                        <td>
                            <a href="{{ route('categorias-livros.edit', $categoria->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('categorias-livros.destroy', $categoria->id) }}" method="POST" style="display:inline;">
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
