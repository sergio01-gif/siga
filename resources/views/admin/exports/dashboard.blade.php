@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Painel do Administrador</h1>

    {{-- FILTRO POR ANO LETIVO --}}
    <div class="flex items-center justify-between mb-6">
        <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-2">
            <label for="ano" class="text-sm text-gray-700">Filtrar por Ano Letivo:</label>
            <select name="ano" id="ano" onchange="this.form.submit()" class="border border-gray-300 rounded px-3 py-1 text-sm">
                <option value="">Todos os anos</option>
                @foreach ($anos as $ano)
                    <option value="{{ $ano->id }}" {{ request('ano') == $ano->id ? 'selected' : '' }}>
                        {{ $ano->nome }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="flex gap-4">
            <a href="{{ route('admin.dashboard.export.pdf', ['ano' => request('ano')]) }}"
               class="text-red-600 text-sm hover:underline flex items-center gap-1">
               📄 Exportar PDF
            </a>
            <a href="{{ route('admin.dashboard.export.excel', ['ano' => request('ano')]) }}"
               class="text-green-600 text-sm hover:underline flex items-center gap-1">
               📊 Exportar Excel
            </a>
        </div>
    </div>

    {{-- CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <x-dashboard-card title="Estudantes" :count="$totalEstudantes" color="blue" />
        <x-dashboard-card title="Professores" :count="$totalProfessores" color="purple" />
        <x-dashboard-card title="Cursos" :count="$totalCursos" color="teal" />
        <x-dashboard-card title="Livros na Biblioteca" :count="$totalLivros" color="indigo" />
        <x-dashboard-card title="Estágios" :count="$totalEstagios" color="orange" />
        <x-dashboard-card title="Faturas Emitidas" :count="$totalFaturas" color="pink" />
        <x-dashboard-card title="Mensalidades Emitidas" :count="$totalMensalidades" color="yellow" />
        <x-dashboard-card title="Mensalidades Pagas" :count="$mensalidadesPagas" color="green" />
        <x-dashboard-card title="Mensalidades em Dívida" :count="$mensalidadesPendentes" color="red" />
    </div>

    <p class="text-center text-sm text-gray-500 mt-10">&copy; {{ date('Y') }} - Sistema de Gestão Acadêmica</p>
</div>
@endsection
