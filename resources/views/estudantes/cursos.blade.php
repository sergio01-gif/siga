@extends('layouts.app')

@section('content')

    <h1>Meu Curso</h1>

    @if($matricula && $matricula->curso)
        <p>Nome do curso: {{ $matricula->curso->nome }}</p>
        <p>Descrição: {{ $matricula->curso->descricao }}</p>
    @else
        <p>Você ainda não está matriculado em nenhum curso.</p>
    @endif

@endsection
