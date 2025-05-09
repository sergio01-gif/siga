@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Usuários</h1>

    <a href="{{ route('admin.usuarios.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Novo Usuário</a>

    <table class="mt-4 w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nome</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
                <tr>
                    <td class="border px-4 py-2">{{ $usuario->id }}</td>
                    <td class="border px-4 py-2">{{ $usuario->nome }}</td>
                    <td class="border px-4 py-2">{{ $usuario->email }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.usuarios.show', $usuario) }}" class="text-blue-500">Ver</a> |
                        <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="text-yellow-500">Editar</a> |
                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Deseja eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-4">Nenhum usuário encontrado.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
