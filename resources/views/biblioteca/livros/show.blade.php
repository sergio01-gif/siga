@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Detalhes do Livro</h1>

    <div class="bg-white shadow rounded p-4">
        <p><strong>Título:</strong> {{ $livro->titulo }}</p>
        <p><strong>Autor:</strong> {{ $livro->autor }}</p>
        <p><strong>Categoria:</strong> {{ $livro->categoria }}</p>
        <p><strong>Código:</strong> {{ $livro->codigo_exemplar }}</p>
        <p><strong>Quantidade:</strong> {{ $livro->quantidade_disponivel }} / {{ $livro->quantidade_total }}</p>
        <p><strong>Editora:</strong> {{ $livro->editora }}</p>
        <p><strong>Ano:</strong> {{ $livro->ano_publicacao }}</p>
        <p><strong>Estado:</strong>
            <span class="px-2 py-1 rounded text-white {{ $livro->estado === 'ativo' ? 'bg-green-500' : 'bg-red-500' }}">
                {{ ucfirst($livro->estado) }}
            </span>
        </p>

        <div class="mt-4 flex gap-4">
            <a href="{{ route('livros.edit', $livro) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Editar</a>
            <a href="{{ route('livros.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Voltar</a>
        </div>
    </div>
</div>
@endsection
