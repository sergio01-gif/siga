@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-[#0072CE]">Turmas</h1>
    <a href="{{ route('turmas.create') }}" class="bg-[#0072CE] text-white px-4 py-2 rounded hover:bg-[#005fa3] text-sm">
        + Nova Turma
    </a>
</div>


    {{-- Filtros --}}
    <form method="GET" class="mb-6 bg-white p-4 rounded shadow flex flex-wrap gap-4">
        <select name="curso_id" class="px-3 py-2 border rounded w-full md:w-1/3">
            <option value="">-- Todos os Cursos --</option>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                    {{ $curso->nome }}
                </option>
            @endforeach
        </select>

        <select name="ano_academico_id" class="px-3 py-2 border rounded w-full md:w-1/3">
            <option value="">-- Todos os Anos Letivos --</option>
            @foreach($anoAcademicos as $ano)
                <option value="{{ $ano->id }}" {{ request('ano_academico_id') == $ano->id ? 'selected' : '' }}>
                    {{ $ano->nome }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-[#0072CE] text-white px-4 py-2 rounded">Filtrar</button>
    </form>

    {{-- Lista de Turmas --}}
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Curso</th>
                    <th class="px-4 py-2">Ano Letivo</th>
                    <th class="px-4 py-2">Criada em</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($turmas as $turma)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $turma->nome }}</td>
                        <td class="px-4 py-2">{{ $turma->curso->nome ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $turma->anoAcademico->nome ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $turma->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('turmas.edit', $turma->id) }}" class="text-blue-600 text-sm hover:underline">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Nenhuma turma encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    <div class="mt-4">
        {{ $turmas->withQueryString()->links() }}
    </div>
</div>
@endsection
