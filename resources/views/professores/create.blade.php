@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-xl font-bold text-[#0072CE] mb-4">Cadastrar Professor</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('professores.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Nome --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="nome" value="{{ old('nome') }}" class="w-full px-3 py-2 border rounded">
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border rounded">
            </div>

            {{-- Telefone --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Telefone</label>
                <input type="text" name="telefone" value="{{ old('telefone') }}" class="w-full px-3 py-2 border rounded">
            </div>

            {{-- Documento de Identificação --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Documento de Identificação</label>
                <input type="text" name="documento_identificacao" value="{{ old('documento_identificacao') }}" class="w-full px-3 py-2 border rounded">
            </div>

            {{-- Tipo de Contratação --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tipo de Contratação</label>
                <select name="tipo_contratacao" class="w-full px-3 py-2 border rounded">
                    <option value="">-- Selecione --</option>
                    <option value="efetivo" {{ old('tipo_contratacao') == 'efetivo' ? 'selected' : '' }}>Efetivo</option>
                    <option value="temporario" {{ old('tipo_contratacao') == 'temporario' ? 'selected' : '' }}>Temporário</option>
                </select>
            </div>

            {{-- Especialidade --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Especialidade</label>
                <input type="text" name="especialidade" value="{{ old('especialidade') }}" class="w-full px-3 py-2 border rounded">
            </div>

            {{-- Usuário Vinculado --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Vincular ao Usuário</label>
                <select name="usuario_id" class="w-full px-3 py-2 border rounded">
                    <option value="">-- Selecione um Usuário --</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Foto --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Foto</label>
                <input type="file" name="foto" class="w-full px-3 py-2 border rounded">
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('professores.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
            <button type="submit" class="bg-[#0072CE] text-white px-6 py-2 rounded">Salvar</button>
        </div>
    </form>
</div>
@endsection
