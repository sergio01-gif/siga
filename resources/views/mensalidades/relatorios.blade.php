@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Relatórios de Mensalidades</h1>

    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <input type="month" name="mes" value="{{ request('mes') }}" class="border px-3 py-2 rounded w-full" placeholder="Mês">
        <select name="estado" class="border px-3 py-2 rounded w-full">
            <option value="">Todos os estados</option>
            <option value="pago" {{ request('estado') == 'pago' ? 'selected' : '' }}>Pago</option>
            <option value="pendente" {{ request('estado') == 'pendente' ? 'selected' : '' }}>Pendente</option>
        </select>
        <input type="text" name="estudante_id" value="{{ request('estudante_id') }}" class="border px-3 py-2 rounded w-full" placeholder="ID do Estudante">
        <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">Filtrar</button>
    </form>

    <div class="mb-4 flex gap-4">
        <a href="{{ route('relatorios.mensalidades.exportPdf', request()->query()) }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Exportar PDF</a>
        <a href="{{ route('relatorios.mensalidades.exportExcel', request()->query()) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Exportar Excel</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">Estudante</th>
                    <th class="py-3 px-6 text-left">Mês</th>
                    <th class="py-3 px-6 text-left">Valor</th>
                    <th class="py-3 px-6 text-left">Estado</th>
                    <th class="py-3 px-6 text-left">Data de Pagamento</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($mensalidades as $mensalidade)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $mensalidade->estudante->nome ?? 'Desconhecido' }}</td>
                        <td class="py-3 px-6">{{ $mensalidade->mes_referencia }}</td>
                        <td class="py-3 px-6">{{ number_format($mensalidade->valor, 2) }} MZN</td>
                        <td class="py-3 px-6">
                            <span class="px-2 py-1 rounded text-white {{ $mensalidade->estado === 'pago' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($mensalidade->estado) }}
                            </span>
                        </td>
                        <td class="py-3 px-6">
                            {{ $mensalidade->data_pagamento ? \Carbon\Carbon::parse($mensalidade->data_pagamento)->format('d/m/Y') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-3 px-6 text-center">Nenhuma mensalidade encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
