@extends('layouts.app')

@section('title', 'Criar Turma')

@section('content')
    <h1 class="text-3xl font-bold">Criar Nova Turma</h1>

    <form action="{{ route('admin.turmas.store') }}" method="POST" class="mt-6">
        @csrf
        <div class="mb-4">
            <label for="nome" class="block">Nome</label>
            <input type="text" name="nome" id="nome" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label for="descricao" class="block">Descrição</label>
            <textarea name="descricao" id="descricao" class="w-full p-2 border"></textarea>
        </div>

        <div class="mb-4">
            <label for="data_inicio" class="block">Data de Início</label>
            <input type="date" name="data_inicio" id="data_inicio" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label for="data_fim" class="block">Data de Fim</label>
            <input type="date" name="data_fim" id="data_fim" class="w-full p-2 border">
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Salvar</button>
    </form>
@endsection
