@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold text-[#0072CE]">Anos Acadêmicos</h1>
        <a href="{{ route('ano-academicos.create') }}"
           class="bg-[#0072CE] text-white px-4 py-2 rounded hover:bg-[#005fa3] text-sm">
           + Novo Ano
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Início</th>
                    <th class="px-4 py-2">Fim</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anoAcademicos as $ano)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $ano->nome }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($ano->inicio)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($ano->fim)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('ano-academicos.edit', $ano->id) }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                            <form action="{{ route('ano-academicos.destroy', $ano->id) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">Nenhum ano cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection