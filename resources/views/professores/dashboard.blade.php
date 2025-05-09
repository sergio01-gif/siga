@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Painel do Professor</h1>

    {{-- Resumo rápido --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white shadow rounded p-4 border-l-4 border-blue-500">
            <p class="text-sm text-gray-600">Disciplinas Lecionadas</p>
            <p class="text-xl font-bold">{{ $cadeiras->count() }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 border-l-4 border-green-500">
            <p class="text-sm text-gray-600">Turmas Associadas</p>
            <p class="text-xl font-bold">{{ $turmas->count() }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 border-l-4 border-purple-500">
            <p class="text-sm text-gray-600">Total de Estudantes</p>
            <p class="text-xl font-bold">{{ $totalEstudantes }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 border-l-4 border-yellow-500">
            <p class="text-sm text-gray-600">Notas Lançadas</p>
            <p class="text-xl font-bold">{{ $totalNotas }}</p>
        </div>
    </div>

    {{-- Lista de Disciplinas --}}
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Suas Disciplinas</h2>
        @if($cadeiras->isNotEmpty())
            <ul class="space-y-2">
                @foreach($cadeiras as $cadeira)
                    <li class="border p-3 rounded hover:bg-gray-50 transition">
                        <strong>{{ $cadeira->nome }}</strong> 
                        @if($cadeira->turma)
                            <span class="text-sm text-gray-500">– Turma {{ $cadeira->turma->nome }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Nenhuma disciplina atribuída.</p>
        @endif
    </div>
</div>
@endsection
