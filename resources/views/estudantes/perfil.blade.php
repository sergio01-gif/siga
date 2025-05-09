@extends('layouts.estudante')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-bold mb-4">Editar Perfil</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('estudante.perfil.atualizar') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="nome" value="{{ old('nome', $estudante->nome) }}" required
                class="w-full mt-1 p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Telefone</label>
            <input type="text" name="telefone" value="{{ old('telefone', $estudante->telefone) }}" required
                class="w-full mt-1 p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $estudante->email) }}"
                class="w-full mt-1 p-2 border rounded">
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>
@endsection
