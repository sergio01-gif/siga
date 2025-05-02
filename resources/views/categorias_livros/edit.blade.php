@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Categoria de Livro</h2>
        <form action="{{ route('categorias-livros.update', $categoriaLivro->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ $categoriaLivro->nome }}" required>
            </div>
            <button type="submit" class="btn btn-warning mt-3">Atualizar</button>
        </form>
    </div>
@endsection
