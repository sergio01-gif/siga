<!-- resources/views/admin/courses/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Adicionar Novo Curso</h1>

    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nome" class="block text-sm font-semibold">Nome do Curso</label>
            <input type="text" name="nome" id="nome" class="w-full p-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="descricao" class="block text-sm font-semibold">Descrição</label>
            <textarea name="descricao" id="descricao" class="w-full p-2 border rounded-lg"></textarea>
        </div>

        <div class="mb-4">
            <label for="duracao" class="block text-sm font-semibold">Duração</label>
            <input type="text" name="duracao" id="duracao" class="w-full p-2 border rounded-lg">
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Salvar Curso</button>
    </form>
</div>
@endsection
