@extends('layouts.app')

@section('content')
    <h1>Turmas do Ano Acadêmico: {{ $anoAcademico->ano_inicio }} - {{ $anoAcademico->ano_fim }}</h1>

    <a href="{{ route('ano_academicos.index') }}" class="btn btn-secondary mb-3">Voltar para Anos Acadêmicos</a>

    @if($turmas->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Nome da Turma</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($turmas as $turma)
                    <tr>
                        <td>{{ $turma->nome }}</td>
                        <td>{{ $turma->curso->nome }}</td>
                        <td>
                            <a href="{{ route('turmas.edit', $turma->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Não existem turmas para este ano acadêmico.</p>
    @endif
@endsection
