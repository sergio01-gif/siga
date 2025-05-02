@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Painel de Controle</h1>
        <p class="text-gray-500">Resumo geral do sistema acadêmico</p>
    </div>

    <!-- Estatísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-blue-100 p-5 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-800">Cursos</p>
                    <p class="text-2xl font-bold text-blue-900">{{ $totalCursos }}</p>
                </div>
                <div class="text-blue-500 text-3xl">
                    📚
                </div>
            </div>
        </div>

        <div class="bg-green-100 p-5 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-800">Estudantes</p>
                    <p class="text-2xl font-bold text-green-900">{{ $totalEstudantes }}</p>
                </div>
                <div class="text-green-500 text-3xl">
                    🎓
                </div>
            </div>
        </div>

        <div class="bg-purple-100 p-5 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-800">Professores</p>
                    <p class="text-2xl font-bold text-purple-900">{{ $totalProfessores }}</p>
                </div>
                <div class="text-purple-500 text-3xl">
                    👨‍🏫
                </div>
            </div>
        </div>

        <div class="bg-yellow-100 p-5 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-yellow-800">Cursos Concluídos</p>
                    <p class="text-2xl font-bold text-yellow-900">{{ $cursosConcluidos }}</p>
                </div>
                <div class="text-yellow-500 text-3xl">
                    ✅
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Alunos por Curso</h2>
            <canvas id="alunosPorCursoChart"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Matrículas por Ano</h2>
            <canvas id="matriculasPorAnoChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const cursosLabels = @json($cursosLabels);
    const cursosData = @json($cursosData);
    const alunosPorCursoCtx = document.getElementById('alunosPorCursoChart').getContext('2d');

    new Chart(alunosPorCursoCtx, {
        type: 'bar',
        data: {
            labels: cursosLabels,
            datasets: [{
                label: 'Estudantes',
                data: cursosData,
                backgroundColor: '#3B82F6',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const anosLabels = @json($anosLabels);
    const matriculasData = @json($matriculasData);
    const matriculasPorAnoCtx = document.getElementById('matriculasPorAnoChart').getContext('2d');

    new Chart(matriculasPorAnoCtx, {
        type: 'line',
        data: {
            labels: anosLabels,
            datasets: [{
                label: 'Matrículas',
                data: matriculasData,
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
