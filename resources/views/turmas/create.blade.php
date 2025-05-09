@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <h1 class="text-xl font-bold text-[#0072CE] mb-4">Nova Turma</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('turmas.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        {{-- Nome da Turma --}}
        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome da Turma</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                   class="mt-1 w-full px-3 py-2 border rounded">
        </div>

        {{-- Curso --}}
        <div>
            <label for="curso_id" class="block text-sm font-medium text-gray-700">Curso</label>
            <select name="curso_id" id="curso_id" class="mt-1 w-full px-3 py-2 border rounded">
                <option value="">-- Selecione o Curso --</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Ano Letivo --}}
        <div>
            <label for="ano_academico_id" class="block text-sm font-medium text-gray-700">Ano Letivo</label>
            <select name="ano_academico_id" id="ano_academico_id" class="mt-1 w-full px-3 py-2 border rounded">
                <option value="">-- Selecione o Ano --</option>
                @foreach($anoAcademicos as $ano)
                    <option value="{{ $ano->id }}" {{ old('ano_academico_id') == $ano->id ? 'selected' : '' }}>
                        {{ $ano->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Botões --}}
        <div class="flex justify-end gap-2">
            <a href="{{ route('turmas.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
            <button type="submit" class="bg-[#0072CE] text-white px-4 py-2 rounded">Salvar</button>
        </div>
    </form>
</div>
@endsection
