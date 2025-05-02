<!-- resources/views/admin/courses/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Cursos</h1>
    <a href="{{ route('admin.courses.create') }}" class="bg-blue-500 text-white p-2 rounded-lg">Adicionar Curso</a>
    
    <table class="min-w-full mt-4 table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Descrição</th>
                <th class="px-4 py-2">Duração</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td class="border px-4 py-2">{{ $course->nome }}</td>
                <td class="border px-4 py-2">{{ $course->descricao }}</td>
                <td class="border px-4 py-2">{{ $course->duracao }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="text-blue-500">Editar</a>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
