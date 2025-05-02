@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Editar Usuário</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
            <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $user->telefone) }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Usuário</label>
            <select name="tipo" id="tipo" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="admin" {{ $user->tipo == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="professor" {{ $user->tipo == 'professor' ? 'selected' : '' }}>Professor</option>
                <option value="aluno" {{ $user->tipo == 'aluno' ? 'selected' : '' }}>Aluno</option>
            </select>
        </div>

        <div>
            <label for="vinculo_id" class="block text-sm font-medium text-gray-700">Vínculo (ID do Professor ou Aluno)</label>
            <input type="number" name="vinculo_id" id="vinculo_id" value="{{ old('vinculo_id', $user->vinculo_id) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            <p class="text-sm text-gray-500 mt-1">Preencha apenas se for professor ou aluno.</p>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Atualizar Usuário
            </button>
        </div>
    </form>
</div>
@endsection
