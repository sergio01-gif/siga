@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Editar Professor</h2>

    <form action="{{ route('admin.professors.update', $professor->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                <input type="text" name="nome" id="nome" value="{{ $professor->nome }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $professor->email }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
            </div>

            <div>
                <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="{{ $professor->telefone }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" value="{{ $professor->data_nascimento }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700">Gênero</label>
                <select name="genero" id="genero" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="Masculino" @if($professor->genero == 'Masculino') selected @endif>Masculino</option>
                    <option value="Feminino" @if($professor->genero == 'Feminino') selected @endif>Feminino</option>
                </select>
            </div>

            <div>
                <label for="morada" class="block text-sm font-medium text-gray-700">Morada</label>
                <input type="text" name="morada" id="morada" value="{{ $professor->morada }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="documento_identificacao" class="block text-sm font-medium text-gray-700">Documento de Identificação</label>
                <input type="text" name="documento_identificacao" id="documento_identificacao" value="{{ $professor->documento_identificacao }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="tipo_contratacao" class="block text-sm font-medium text-gray-700">Tipo de Contratação</label>
                <select name="tipo_contratacao" id="tipo_contratacao" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="Tempo Inteiro" @if($professor->tipo_contratacao == 'Tempo Inteiro') selected @endif>Tempo Inteiro</option>
                    <option value="Tempo Parcial" @if($professor->tipo_contratacao == 'Tempo Parcial') selected @endif>Tempo Parcial</option>
                </select>
            </div>

            <div>
                <label for="especialidade" class="block text-sm font-medium text-gray-700">Especialidade</label>
                <input type="text" name="especialidade" id="especialidade" value="{{ $professor->especialidade }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="estado" id="estado" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="Ativo" @if($professor->estado == 'Ativo') selected @endif>Ativo</option>
                    <option value="Inativo" @if($professor->estado == 'Inativo') selected @endif>Inativo</option>
                </select>
            </div>

            <div class="col-span-2">
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto (opcional)</label>
                <input type="file" name="foto" id="foto" class="mt-1 block w-full text-gray-700">
            </div>
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Atualizar Professor
            </button>
        </div>
    </form>
</div>
@endsection
