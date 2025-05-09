@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Lista de Livros</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('livros.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Novo Livro</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Título</th>
                    <th class="py-3 px-6 text-left">Autor</th>
                    <th class="py-3 px-6 text-left">Código</th>
                    <th class="py-3 px-6 text-left">Quantidade</th>
                    <th class="py-3 px-6 text-left">Estado</th>
                    <th class="py-3 px-6 text-left">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($livros as $livro)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $livro->titulo }}</td>
                        <td class="py-3 px-6">{{ $livro->autor }}</td>
                        <td class="py-3 px-6">{{ $livro->codigo_exemplar }}</td>
                        <td class="py-3 px-6">{{ $livro->quantidade_disponivel }} / {{ $livro->quantidade_total }}</td>
                        <td class="py-3 px-6">
                            <span class="px-2 py-1 rounded text-white {{ $livro->estado === 'ativo' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($livro->estado) }}
                            </span>
                        </td>
                        <td class="py-3 px-6 flex gap-2">
                            <a href="{{ route('livros.show', $livro) }}" class="text-blue-500 hover:underline">Ver</a>
                            <a href="{{ route('livros.edit', $livro) }}" class="text-yellow-500 hover:underline">Editar</a>
                            <form action="{{ route('livros.destroy', $livro) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $livros->links() }}
    </div>
</div>
@endsection
