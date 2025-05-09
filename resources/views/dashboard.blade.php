@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="text-2xl font-semibold text-center mb-6">Bem-vindo ao Painel de Administração</div>
        
        <!-- Painel de Estatísticas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Total de Cursos -->
            <div class="bg-blue-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-blue-800 text-sm font-semibold mb-2">Total de Cursos</div>
                <div class="text-blue-900 text-3xl font-bold">{{ $totalCursos }}</div>
            </div>

            <!-- Total de Estudantes -->
            <div class="bg-green-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-green-800 text-sm font-semibold mb-2">Total de Estudantes</div>
                <div class="text-green-900 text-3xl font-bold">{{ $totalEstudantes }}</div>
            </div>

            <!-- Total de Professores -->
            <div class="bg-yellow-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-yellow-800 text-sm font-semibold mb-2">Total de Professores</div>
                <div class="text-yellow-900 text-3xl font-bold">{{ $totalProfessores }}</div>
            </div>

            <!-- Total de Estágios -->
            <div class="bg-red-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-red-800 text-sm font-semibold mb-2">Total de Estágios</div>
                <div class="text-red-900 text-3xl font-bold">{{ $totalEstagios }}</div>
            </div>
        </div>

        <!-- Estatísticas Adicionais -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-10">
            <!-- Total de Faturas -->
            <div class="bg-purple-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-purple-800 text-sm font-semibold mb-2">Total de Faturas</div>
                <div class="text-purple-900 text-3xl font-bold">{{ $totalFaturas }}</div>
            </div>

            <!-- Total de Livros -->
            <div class="bg-indigo-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-indigo-800 text-sm font-semibold mb-2">Total de Livros</div>
                <div class="text-indigo-900 text-3xl font-bold">{{ $totalLivros }}</div>
            </div>

            <!-- Cursos Coordenados -->
            <div class="bg-teal-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-teal-800 text-sm font-semibold mb-2">Cursos Coordenados</div>
                <div class="text-teal-900 text-3xl font-bold">{{ $cursosCoordenados }}</div>
            </div>
        </div>

        <!-- Novas Informações de Mensalidades -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6 mt-10">
            <!-- Total de Mensalidades -->
            <div class="bg-orange-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-orange-800 text-sm font-semibold mb-2">Total de Mensalidades</div>
                <div class="text-orange-900 text-3xl font-bold">{{ $totalMensalidades }}</div>
            </div>

            <!-- Mensalidades Pagas -->
            <div class="bg-teal-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-teal-800 text-sm font-semibold mb-2">Mensalidades Pagas</div>
                <div class="text-teal-900 text-3xl font-bold">{{ $mensalidadesPagas }}</div>
            </div>

            <!-- Mensalidades Devidas -->
            <div class="bg-red-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-red-800 text-sm font-semibold mb-2">Mensalidades Devidas</div>
                <div class="text-red-900 text-3xl font-bold">{{ $mensalidadesDevidas }}</div>
            </div>

            <!-- Total de Dívidas -->
            <div class="bg-pink-100 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center text-center">
                <div class="text-pink-800 text-sm font-semibold mb-2">Total de Dívidas</div>
                <div class="text-pink-900 text-3xl font-bold">{{ $dividaTotal }}</div>
            </div>
        </div>
        <!-- Informações adicionais -->
        <div class="mt-10 text-center">
            <a href="{{ route('cursos.index') }}" class="bg-blue-500 text-white py-2 px-6 rounded-lg shadow-md hover:bg-blue-600">Ver Todos os Cursos</a>
            <a href="{{ route('estudantes.index') }}" class="bg-green-500 text-white py-2 px-6 rounded-lg shadow-md hover:bg-green-600 ml-4">Ver Todos os Estudantes</a>
            <a href="{{ route('professores.index') }}" class="bg-yellow-500 text-white py-2 px-6 rounded-lg shadow-md hover:bg-yellow-600 ml-4">Ver Todos os Professores</a>
        </div>
    </div>
@endsection
