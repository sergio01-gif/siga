@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Lista de Usuários</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Nome</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Tipo</th>
                <th class="py-2 px-4 border-b">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $usuario->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $usuario->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $usuario->email }}</td>
                    <td class="py-2 px-4 border-b">{{ ucfirst($usuario->tipo) }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="#" class="text-blue-500 hover:underline">Ver</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 px-4 text-center text-gray-500">Nenhum usuário encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
