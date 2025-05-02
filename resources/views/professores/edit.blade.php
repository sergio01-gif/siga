@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Editar Professor</h2>

    <form action="{{ route('professores.update', $professor->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $professor->nome) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $professor->email) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div>
                <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $professor->telefone) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div>
                <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento', $professor->data_nascimento) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700">Gênero</label>
                <select name="genero" id="genero" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                    <option value="Masculino" {{ $professor->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Feminino" {{ $professor->genero == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>

            <div>
                <label for="morada" class="block text-sm font-medium text-gray-700">Morada</label>
                <input type="text" name="morada" id="morada" value="{{ old('morada', $professor->morada) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div>
                <label for="documento_identificacao" class="block text-sm font-medium text-gray-700">Documento de Identificação</label>
                <input type="text" name="documento_identificacao" id="documento_identificacao" value="{{ old('documento_identificacao', $professor->documento_identificacao) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div>
                <label for="tipo_contratacao" class="block text-sm font-medium text-gray-700">Tipo de Contratação</label>
                <select name="tipo_contratacao" id="tipo_contratacao" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                    <option value="Tempo Inteiro" {{ $professor->tipo_contratacao == 'Tempo Inteiro' ? 'selected' : '' }}>Tempo Inteiro</option>
                    <option value="Tempo Parcial" {{ $professor->tipo_contratacao == 'Tempo Parcial' ? 'selected' : '' }}>Tempo Parcial</option>
                </select>
            </div>

            <div>
                <label for="especialidade" class="block text-sm font-medium text-gray-700">Especialidade</label>
                <input type="text" name="especialidade" id="especialidade" value="{{ old('especialidade', $professor->especialidade) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="estado" id="estado" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                    <option value="Ativo" {{ $professor->estado == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                    <option value="Inativo" {{ $professor->estado == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>

            <div class="col-span-2">
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                <input type="file" name="foto" id="foto" class="mt-1 block w-full text-gray-700">
                @if ($professor->foto)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $professor->foto) }}" alt="Foto atual" class="h-24 rounded">
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Atualizar Professor
            </button>
        </div>
    </form>
</div>
@endsection
