@extends('layouts.app')

@section('content')
    <h1>Detalhes da Turma</h1>
    <p><strong>Nome:</strong> {{ $turma->nome }}</p>
    <p><strong>Ano Acadêmico:</strong> {{ $turma->anoAcademico->ano }}</p>
    <p><strong>Curso:</strong> {{ $turma->curso->nome }}</p>
    <a href="{{ route('turmas.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
