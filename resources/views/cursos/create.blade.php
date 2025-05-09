@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <h1 class="text-xl font-bold text-[#0072CE] mb-4">Novo Curso</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cursos.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        {{-- Nome --}}
        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                   class="mt-1 w-full px-3 py-2 border rounded">
        </div>

        {{-- Código --}}
        <div>
            <label for="codigo" class="block text-sm font-medium text-gray-700">Código</label>
            <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}"
                   class="mt-1 w-full px-3 py-2 border rounded">
        </div>

        {{-- Duração --}}
        <div>
            <label for="duracao" class="block text-sm font-medium text-gray-700">Duração (meses)</label>
            <input type="number" name="duracao" id="duracao" value="{{ old('duracao') }}"
                   class="mt-1 w-full px-3 py-2 border rounded">
        </div>

        {{-- Descrição --}}
        <div>
            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
            <textarea name="descricao" id="descricao" rows="3"
                      class="mt-1 w-full px-3 py-2 border rounded">{{ old('descricao') }}</textarea>
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 w-full px-3 py-2 border rounded">
                <option value="ativo" {{ old('status') === 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('status') === 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        {{-- Coordenador (opcional) --}}
        <div>
            <label for="coordenador_id" class="block text-sm font-medium text-gray-700">Coordenador (ID opcional)</label>
            <input type="number" name="coordenador_id" id="coordenador_id" value="{{ old('coordenador_id') }}"
                   class="mt-1 w-full px-3 py-2 border rounded">
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cursos.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
            <button type="submit" class="bg-[#0072CE] text-white px-4 py-2 rounded">Salvar</button>
        </div>
    </form>
</div>
@endsection
