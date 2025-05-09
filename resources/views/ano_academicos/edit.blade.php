{{-- EDIT VIEW --}}

@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <h1 class="text-xl font-bold text-[#0072CE] mb-4">Editar Ano Acadêmico</h1>

    <form action="{{ route('ano-academicos.update', $anoAcademico->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $anoAcademico->nome) }}"
                   class="mt-1 w-full px-3 py-2 border rounded focus:ring-[#0072CE] focus:border-[#0072CE]">
            @error('nome')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="inicio" class="block text-sm font-medium text-gray-700">Data de Início</label>
            <input type="date" name="inicio" id="inicio" value="{{ old('inicio', $anoAcademico->inicio) }}"
                   class="mt-1 w-full px-3 py-2 border rounded">
            @error('inicio')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="fim" class="block text-sm font-medium text-gray-700">Data de Fim</label>
            <input type="date" name="fim" id="fim" value="{{ old('fim', $anoAcademico->fim) }}"
                   class="mt-1 w-full px-3 py-2 border rounded">
            @error('fim')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('ano-academicos.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
            <button type="submit" class="bg-[#0072CE] text-white px-4 py-2 rounded hover:bg-[#005fa3] text-sm">Atualizar</button>
        </div>
    </form>
</div>
@endsection