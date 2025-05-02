@extends('layouts.app')

@section('title', 'Editar Turma')

@section('content')
    <h1 class="text-3xl font-bold">Editar Turma</h1>

    <form action="{{ route('turmas.update', $turma->id) }}" method="POST" class="mt-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nome" class="block">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $turma->nome) }}" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label for="descricao" class="block">Descrição</label>
            <textarea name="descricao" id="descricao" class="w-full p-2 border">{{ old('descricao', $turma->descricao) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="data_inicio" class="block">Data de Início</label>
            <input type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio', $turma->data_inicio) }}" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label for="data_fim" class="block">Data de Fim</label>
            <input type="date" name="data_fim" id="data_fim" value="{{ old('data_fim', $turma->data_fim) }}" class="w-full p-2 border">
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Salvar</button>
    </form>
@endsection
