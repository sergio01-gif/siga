@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Livro</h1>
        <form action="{{ route('livros.update', $livro) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $livro->titulo }}" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" value="{{ $livro->autor }}" required>
            </div>
            <div class="form-group">
                <label for="editora">Editora</label>
                <input type="text" class="form-control" id="editora" name="editora" value="{{ $livro->editora }}" required>
            </div>
            <div class="form-group">
                <label for="ano_publicacao">Ano de Publicação</label>
                <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" value="{{ $livro->ano_publicacao }}" required>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ $livro->quantidade }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        </form>
    </div>
@endsection
