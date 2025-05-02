@extends('layouts.app')

@section('content')
    <h1>Detalhes do Curso</h1>
    <p><strong>Nome:</strong> {{ $curso->nome }}</p>
    <p><strong>Código:</strong> {{ $curso->codigo }}</p>
    <p><strong>Duração:</strong> {{ $curso->duracao }} anos</p>
    <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
