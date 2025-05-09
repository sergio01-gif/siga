@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Adicionar Novo Usuário</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.usuarios.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nome" class="block font-semibold mb-1">Nome</label>
            <input type="text" id="nome" name="nome" class="w-full border px-3 py-2 rounded" value="{{ old('nome') }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email') }}" required>
        </div>

        <div class="mb-4">
            <label for="senha" class="block font-semibold mb-1">Senha</label>
            <input type="password" id="senha" name="senha" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
            <a href="{{ route('admin.usuarios.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
        </div>
    </form>
</div>
@endsection
