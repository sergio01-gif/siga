@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Detalhes do Aluno</h2>

    <div class="mb-4">
        <strong>Nome:</strong> {{ $student->nome }}
    </div>
    <div class="mb-4">
        <strong>Email:</strong> {{ $student->email }}
    </div>
    <div class="mb-4">
        <strong>Telefone:</strong> {{ $student->telefone }}
    </div>
    <div class="mb-4">
        <strong>Curso:</strong> {{ $student->curso->nome ?? 'Não atribuído' }}
    </div>
    <div class="mb-4">
        <strong>Ano Letivo:</strong> {{ $student->ano_lectivo }}
    </div>
    <div class="mb-4">
        <strong>Estado:</strong> {{ $student->estado }}
    </div>

    <a href="{{ route('admin.students.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Voltar</a>
</div>
@endsection
