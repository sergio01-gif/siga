@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Empréstimos de Livros</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('emprestimos.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Novo Empréstimo</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Livro</th>
                    <th class="py-3 px-6 text-left">Estudante</th>
                    <th class="py-3 px-6 text-left">Emprestado em</th>
                    <th class="py-3 px-6 text-left">Devolver até</th>
                    <th class="py-3 px-6 text-left">Estado</th>
                    <th class="py-3 px-6 text-left">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($emprestimos as $e)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $e->livro->titulo }}</td>
                        <td class="py-3 px-6">{{ $e->estudante->nome }}</td>
                        <td class="py-3 px-6">{{ \Carbon\Carbon::parse($e->data_emprestimo)->format('d/m/Y') }}</td>
                        <td class="py-3 px-6">{{ \Carbon\Carbon::parse($e->data_devolucao_prevista)->format('d/m/Y') }}</td>
                        <td class="py-3 px-6">
                            <span class="px-2 py-1 rounded text-white {{ $e->estado === 'devolvido' ? 'bg-green-500' : ($e->estado === 'atrasado' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                {{ ucfirst($e->estado) }}
                            </span>
                        </td>
                        <td class="py-3 px-6 flex gap-2">
                            @if($e->estado === 'pendente')
                                <form action="{{ route('emprestimos.devolver', $e) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:underline">Devolver</button>
                                </form>
                            @endif
                            <form action="{{ route('emprestimos.destroy', $e) }}" method="POST" onsubmit="return confirm('Deseja remover?')">
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
        {{ $emprestimos->links() }}
    </div>
</div>
@endsection
