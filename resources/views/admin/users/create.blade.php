@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Criar Novo Usuário</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
            <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Usuário</label>
            <select name="tipo" id="tipo" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">-- Selecione --</option>
                <option value="admin">Admin</option>
                <option value="professor">Professor</option>
                <option value="aluno">Aluno</option>
            </select>
        </div>

        <div>
            <label for="vinculo_id" class="block text-sm font-medium text-gray-700">Vínculo (ID do Professor ou Aluno)</label>
            <input type="number" name="vinculo_id" id="vinculo_id" class="w-full border border-gray-300 rounded px-3 py-2">
            <p class="text-sm text-gray-500 mt-1">Preencha apenas se for professor ou aluno.</p>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Criar Usuário
            </button>
        </div>
    </form>
</div>
@endsection
