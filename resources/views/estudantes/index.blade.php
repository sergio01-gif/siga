@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Lista de Estudantes</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-400 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtros -->
    <form method="GET" action="{{ route('estudantes.index') }}" class="mb-4 grid md:grid-cols-4 gap-4">
        <select name="ano_lectivo_id" class="border rounded px-4 py-2">
            <option value="">Ano Letivo</option>
            @foreach($anos as $ano)
                <option value="{{ $ano->id }}" {{ request('ano_lectivo_id') == $ano->id ? 'selected' : '' }}>
                    {{ $ano->nome }}
                </option>
            @endforeach
        </select>

        <select name="curso_id" class="border rounded px-4 py-2">
            <option value="">Curso</option>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                    {{ $curso->nome }}
                </option>
            @endforeach
        </select>

        <select name="turma_id" class="border rounded px-4 py-2">
            <option value="">Turma</option>
            @foreach($turmas as $turma)
                <option value="{{ $turma->id }}" {{ request('turma_id') == $turma->id ? 'selected' : '' }}>
                    {{ $turma->nome }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700">Filtrar</button>
    </form>

    <!-- Botões -->
    <div class="flex flex-wrap gap-4 mb-6">
        <a href="{{ route('estudantes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Adicionar Estudante
        </a>

        <a href="{{ route('estudantes.exportPdf', request()->query()) }}"
           class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            📄 Exportar PDF
        </a>

        <a href="{{ route('estudantes.exportExcel', request()->query()) }}"
           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            📊 Exportar Excel
        </a>
    </div>

    <!-- Tabela -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Curso</th>
                    <th class="px-4 py-2">Turma</th>
                    <th class="px-4 py-2">Ano Letivo</th>
                    <th class="px-4 py-2">Telefone</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($estudantes as $estudante)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $estudante->nome }}</td>
                        <td class="px-4 py-2">{{ $estudante->curso->nome ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $estudante->turma->nome ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $estudante->ano_lectivo->nome ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $estudante->telefone }}</td>
                        <td class="px-4 py-2 capitalize">{{ $estudante->estado }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('estudantes.edit', $estudante->id) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                            <form action="{{ route('estudantes.destroy', $estudante->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja remover este estudante?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 px-4 py-4">Nenhum estudante encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="mt-4">
        {{ $estudantes->appends(request()->query())->links() }}
    </div>
</div>
@endsection
