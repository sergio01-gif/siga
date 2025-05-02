@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Lista de Professores</h2>
        <a href="{{ route('admin.professors.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Adicionar Professor
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b text-left">Nome</th>
                <th class="py-2 px-4 border-b text-left">Email</th>
                <th class="py-2 px-4 border-b text-left">Telefone</th>
                <th class="py-2 px-4 border-b text-left">Especialidade</th>
                <th class="py-2 px-4 border-b text-left">Estado</th>
                <th class="py-2 px-4 border-b text-left">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($professors as $professor)
            <tr>
                <td class="py-2 px-4 border-b">{{ $professor->nome }}</td>
                <td class="py-2 px-4 border-b">{{ $professor->email }}</td>
                <td class="py-2 px-4 border-b">{{ $professor->telefone }}</td>
                <td class="py-2 px-4 border-b">{{ $professor->especialidade }}</td>
                <td class="py-2 px-4 border-b">
                    <span class="{{ $professor->estado == 'Ativo' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $professor->estado }}
                    </span>
                </td>
                <td class="py-2 px-4 border-b flex gap-2">
                    <a href="{{ route('admin.professors.edit', $professor->id) }}" class="text-blue-600 hover:underline">Editar</a>
                    <form action="{{ route('admin.professors.destroy', $professor->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este professor?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($professors->isEmpty())
            <tr>
                <td colspan="6" class="py-4 px-4 text-center text-gray-500">Nenhum professor cadastrado.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
