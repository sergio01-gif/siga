@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Painel do Administrador</h1>

    <!-- Filtro por Ano Letivo -->
    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-6">
        <label class="block mb-1 font-semibold">Filtrar por Ano Letivo:</label>
        <select name="ano_id" onchange="this.form.submit()" class="border px-4 py-2 rounded w-full md:w-64">
            <option value="">Todos os anos</option>
            @foreach($anos as $ano)
                <option value="{{ $ano->id }}" {{ $anoId == $ano->id ? 'selected' : '' }}>
                    {{ $ano->nome }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Botões de Exportação -->
    <div class="flex gap-4 mb-6">
        <a href="{{ route('admin.dashboard.export.pdf', ['ano_id' => $anoId]) }}"
           class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            📄 Exportar PDF
        </a>

        <a href="{{ route('admin.dashboard.export.excel', ['ano_id' => $anoId]) }}"
           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            📊 Exportar Excel
        </a>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold text-gray-700">Estudantes</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $totalEstudantes }}</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold text-gray-700">Professores</h2>
            <p class="text-3xl font-bold text-green-600">{{ $totalProfessores }}</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold text-gray-700">Cursos</h2>
            <p class="text-3xl font-bold text-purple-600">{{ $totalCursos }}</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold text-gray-700">Livros na Biblioteca</h2>
            <p class="text-3xl font-bold text-yellow-600">{{ $totalLivros }}</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold text-gray-700">Estágios</h2>
            <p class="text-3xl font-bold text-red-500">{{ $totalEstagios }}</p>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        <!-- Estudantes por curso -->
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Estudantes por Curso</h2>
            <canvas id="estudantesPorCursoChart" height="200"></canvas>
        </div>

        <!-- Mensalidades pagas vs pendentes -->
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Mensalidades Pagas vs Pendentes</h2>
            <canvas id="mensalidadesChart" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Estudantes por curso
    const estudantesPorCursoCtx = document.getElementById('estudantesPorCursoChart').getContext('2d');
    new Chart(estudantesPorCursoCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($estudantesPorCurso->keys()) !!},
            datasets: [{
                label: 'Estudantes',
                data: {!! json_encode($estudantesPorCurso->values()) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.7)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Mensalidades
    const mensalidadesCtx = document.getElementById('mensalidadesChart').getContext('2d');
    new Chart(mensalidadesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pagas', 'Pendentes'],
            datasets: [{
                data: [{{ $mensalidadesPagas }}, {{ $mensalidadesPendentes }}],
                backgroundColor: ['#10b981', '#ef4444']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endsection
