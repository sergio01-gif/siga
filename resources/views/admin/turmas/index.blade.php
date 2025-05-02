@extends('layouts.app')

@section('title', 'Gestão de Turmas')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold">Turmas</h1>

    <a href="{{ route('admin.turmas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
        + Nova Turma
    </a>
</div>

<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full table-auto border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3 text-left">Nome</th>
                <th class="border p-3 text-left">Descrição</th>
                <th class="border p-3 text-left">Data Início</th>
                <th class="border p-3 text-left">Data Fim</th>
                <th class="border p-3 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($turmas as $turma)
                <tr class="hover:bg-gray-50">
                    <td class="border p-3">{{ $turma->nome }}</td>
                    <td class="border p-3">{{ $turma->descricao }}</td>
                    <td class="border p-3">{{ \Carbon\Carbon::parse($turma->data_inicio)->format('d/m/Y') }}</td>
                    <td class="border p-3">{{ \Carbon\Carbon::parse($turma->data_fim)->format('d/m/Y') }}</td>
                    <td class="border p-3 text-center">
                        <a href="{{ route('admin.turmas.edit', $turma->id) }}" class="text-indigo-600 hover:underline mr-2">Editar</a>
                        <form action="{{ route('admin.turmas.destroy', $turma->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta turma?')" class="text-red-600 hover:underline">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border p-4 text-center text-gray-500">Nenhuma turma cadastrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
