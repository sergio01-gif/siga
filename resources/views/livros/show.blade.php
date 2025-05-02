@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $livro->titulo }}</h1>
        <p><strong>Autor:</strong> {{ $livro->autor }}</p>
        <p><strong>Categoria:</strong> {{ $livro->categoria->nome }}</p>
        <p><strong>Descrição:</strong> {{ $livro->descricao }}</p>
        <p><strong>Ano de Publicação:</strong> {{ $livro->ano_publicacao }}</p>

        <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
