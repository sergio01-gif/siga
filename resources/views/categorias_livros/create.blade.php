@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Criar Nova Categoria de Livro</h2>
        <form action="{{ route('categorias-livros.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Salvar</button>
        </form>
    </div>
@endsection
