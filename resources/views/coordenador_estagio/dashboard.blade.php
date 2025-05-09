@extends('layouts.app')<!-- Certifique-se que este layout tem o sidebar e topbar -->

@section('title', 'Painel do Coordenador de Estágio')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Blocos de Estatísticas -->
    <div class="bg-white p-4 shadow rounded-xl">
        <h2 class="text-sm font-medium text-gray-500">Estágios Ativos</h2>
        <p class="text-2xl font-bold text-blue-600">{{ $estagiosAtivos }}</p>
    </div>
    <div class="bg-white p-4 shadow rounded-xl">
        <h2 class="text-sm font-medium text-gray-500">Estudantes</h2>
        <p class="text-2xl font-bold text-green-600">{{ $estudantes }}</p>
    </div>
    <div class="bg-white p-4 shadow rounded-xl">
        <h2 class="text-sm font-medium text-gray-500">Supervisores</h2>
        <p class="text-2xl font-bold text-indigo-600">{{ $supervisores }}</p>
    </div>
    <div class="bg-white p-4 shadow rounded-xl">
        <h2 class="text-sm font-medium text-gray-500">Relatórios Pendentes</h2>
        <p class="text-2xl font-bold text-red-600">{{ $relatoriosPendentes }}</p>
    </div>
</div>

<!-- Últimos Relatórios -->
<div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-lg font-semibold mb-4">Últimos Relatórios Submetidos</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-xs uppercase">
                <tr>
                    <th class="px-4 py-2">Estudante</th>
                    <th class="px-4 py-2">Supervisor</th>
                    <th class="px-4 py-2">Data</th>
                    <th class="px-4 py-2">Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($relatorios as $relatorio)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $relatorio->estudante->nome }}</td>
                        <td class="px-4 py-2">{{ $relatorio->supervisor->nome }}</td>
                        <td class="px-4 py-2">{{ $relatorio->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            @if($relatorio->estado === 'pendente')
                                <span class="text-yellow-600 font-semibold">Pendente</span>
                            @else
                                <span class="text-green-600 font-semibold">Aprovado</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-400">Nenhum relatório encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
