@extends('layouts.app')

@section('content')
    <h1>Detalhes do Ano Acadêmico</h1>
    <p><strong>Ano de Início:</strong> {{ $ano->ano_inicio }}</p>
    <p><strong>Ano de Fim:</strong> {{ $ano->ano_fim }}</p>
    <p><strong>Status:</strong> {{ $ano->status }}</p>
    <a href="{{ route('ano_academicos.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
