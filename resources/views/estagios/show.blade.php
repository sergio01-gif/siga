@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-white mb-4">Detalhes do Estágio</h1>

    <div class="card bg-dark text-white">
        <div class="card-body">
            <h5 class="card-title">{{ $estagio->titulo }}</h5>
            <p class="card-text">{{ $estagio->descricao }}</p>
            <p><strong>Estudante:</strong> {{ $estagio->estudante->nome ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($estagio->status) }}</p>
            <p><strong>Data de Início:</strong> {{ $estagio->data_inicio }}</p>
            <p><strong>Data de Fim:</strong> {{ $estagio->data_fim }}</p>
        </div>
    </div>

    <a href="{{ route('estagios.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
