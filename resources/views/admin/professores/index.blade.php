@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-[#0072CE]">Professores</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.professores.exportPdf', request()->query()) }}"
           class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            📄 Exportar PDF
        </a>

        <a href="{{ route('admin.professores.exportExcel', request()->query()) }}"
           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            📊 Exportar Excel
        </a>
            <a href="{{ route('professores.create') }}" class="bg-[#0072CE] text-white px-4 py-2 rounded text-sm hover:bg-[#005fa3]">
                + Novo Professor
            </a>
        </div>
    </div>

    {{-- Filtros --}}
    <form method="GET" class="bg-white p-4 rounded shadow mb-6 flex flex-wrap gap-4">
        <input type="text" name="especialidade" placeholder="Especialidade" value="{{ request('especialidade') }}"
               class="w-full md:w-1/3 px-3 py-2 border rounded">

        <select name="tipo_contratacao" class="w-full md:w-1/3 px-3 py-2 border rounded">
            <option value="">-- Tipo de Contratação --</option>
            <option value="efetivo" {{ request('tipo_contratacao') == 'efetivo' ? 'selected' : '' }}>Efetivo</option>
            <option value="temporario" {{ request('tipo_contratacao') == 'temporario' ? 'selected' : '' }}>Temporário</option>
        </select>

        <button type="submit" class="bg-[#0072CE] text-white px-4 py-2 rounded">Filtrar</button>
    </form>

    {{-- Tabela --}}
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Telefone</th>
                    <th class="px-4 py-2">Especialidade</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($professores as $professor)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $professor->nome }}</td>
                        <td class="px-4 py-2">{{ $professor->email }}</td>
                        <td class="px-4 py-2">{{ $professor->telefone }}</td>
                        <td class="px-4 py-2">{{ $professor->especialidade }}</td>
                        <td class="px-4 py-2">{{ ucfirst($professor->tipo_contratacao) }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('professores.edit', $professor->id) }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center px-4 py-4 text-gray-500">Nenhum professor encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    <div class="mt-4">
        {{ $professores->withQueryString()->links() }}
    </div>
</div>
@endsection
