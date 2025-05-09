@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Detalhes da Mensalidade</h1>

    <div class="bg-white shadow rounded p-4">
        <p><strong>Estudante:</strong> {{ $mensalidade->estudante->nome ?? 'Desconhecido' }}</p>
        <p><strong>Mês de Referência:</strong> {{ $mensalidade->mes_referencia }}</p>
        <p><strong>Valor:</strong> {{ number_format($mensalidade->valor, 2) }} MZN</p>
        <p><strong>Estado:</strong> 
            <span class="px-2 py-1 rounded text-white {{ $mensalidade->estado === 'pago' ? 'bg-green-500' : 'bg-red-500' }}">
                {{ ucfirst($mensalidade->estado) }}
            </span>
        </p>
        @if($mensalidade->data_pagamento)
            <p><strong>Data de Pagamento:</strong> {{ \Carbon\Carbon::parse($mensalidade->data_pagamento)->format('d/m/Y H:i') }}</p>
        @endif

        <div class="mt-4 flex gap-4">
            <a href="{{ route('mensalidades.edit', $mensalidade) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Editar</a>
            <a href="{{ route('mensalidades.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Voltar</a>
        </div>
    </div>
</div>
@endsection
