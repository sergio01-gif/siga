@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Mensalidades</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('mensalidades.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Nova Mensalidade</a>
    </div>

    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <input type="text" name="mes" placeholder="Mês" value="{{ request('mes') }}" class="border px-3 py-2 rounded w-full">
        <select name="estado" class="border px-3 py-2 rounded w-full">
            <option value="">Todos os estados</option>
            <option value="pago" {{ request('estado') == 'pago' ? 'selected' : '' }}>Pago</option>
            <option value="pendente" {{ request('estado') == 'pendente' ? 'selected' : '' }}>Pendente</option>
        </select>
        <input type="text" name="estudante_id" placeholder="ID do Estudante" value="{{ request('estudante_id') }}" class="border px-3 py-2 rounded w-full">
        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Filtrar</button>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Aluno</th>
                    <th class="py-3 px-6 text-left">Mês</th>
                    <th class="py-3 px-6 text-left">Valor</th>
                    <th class="py-3 px-6 text-left">Estado</th>
                    <th class="py-3 px-6 text-left">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($mensalidades as $mensalidade)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $mensalidade->estudante->nome ?? 'Desconhecido' }}</td>
                        <td class="py-3 px-6">{{ $mensalidade->mes_referencia }}</td>
                        <td class="py-3 px-6">{{ number_format($mensalidade->valor, 2) }} MZN</td>
                        <td class="py-3 px-6">
                            <span class="px-2 py-1 rounded text-white {{ $mensalidade->estado === 'pago' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($mensalidade->estado) }}
                            </span>
                        </td>
                        <td class="py-3 px-6 flex gap-2">
                            <a href="{{ route('mensalidades.show', $mensalidade) }}" class="text-blue-500 hover:underline">Ver</a>
                            <a href="{{ route('mensalidades.edit', $mensalidade) }}" class="text-yellow-500 hover:underline">Editar</a>
                            <form action="{{ route('mensalidades.destroy', $mensalidade) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                            @if($mensalidade->estado === 'pendente')
                                <form action="{{ route('mensalidades.marcarComoPago', $mensalidade) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:underline">Marcar como Pago</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $mensalidades->withQueryString()->links() }}
    </div>
</div>
@endsection
