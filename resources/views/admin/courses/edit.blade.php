<!-- resources/views/admin/courses/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Editar Curso</h1>

    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nome" class="block text-sm font-semibold">Nome do Curso</label>
            <input type="text" name="nome" id="nome" class="w-full p-2 border rounded-lg" value="{{ $course->nome }}" required>
        </div>

        <div class="mb-4">
            <label for="descricao" class="block text-sm font-semibold">Descrição</label>
            <textarea name="descricao" id="descricao" class="w-full p-2 border rounded-lg">{{ $course->descricao }}</textarea>
        </div>

        <div class="mb-4">
            <label for="duracao" class="block text-sm font-semibold">Duração</label>
            <input type="text" name="duracao" id="duracao" class="w-full p-2 border rounded-lg" value="{{ $course->duracao }}">
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Atualizar Curso</button>
    </form>
</div>
@endsection
