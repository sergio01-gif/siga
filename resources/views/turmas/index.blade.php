@extends('layouts.app')

@section('content')
    <h1>Lista de Turmas</h1>
    <a href="{{ route('turmas.create') }}" class="btn btn-primary">Adicionar Nova Turma</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nome da Turma</th>
                <th>Ano Acadêmico</th>
                <th>Curso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($turmas as $turma)
                <tr>
                    <td>{{ $turma->nome }}</td>
                    <td>{{ $turma->anoAcademico->ano_inicio }} - {{ $turma->anoAcademico->ano_fim }}</td>
                    <td>{{ $turma->curso->nome }}</td>
                    <td>
                        <a href="{{ route('turmas.edit', $turma->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('turmas.destroy', $turma->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                        <a href="{{ route('turmas.estudantes', $turma->id) }}" class="btn btn-info btn-sm">Ver Estudantes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
