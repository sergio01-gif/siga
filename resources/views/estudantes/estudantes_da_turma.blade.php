@extends('layouts.app')

@section('content')
    <h1>Estudantes da Turma: {{ $turma->nome }}</h1>

    <a href="{{ route('turmas.index') }}" class="btn btn-secondary mb-3">Voltar</a>

    @if(!empty($estudantes) && $estudantes->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nome do Estudante</th>
                    <th>Data de Nascimento</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudantes as $estudante)
                    <tr>
                        <td>{{ $estudante->nome }}</td>
                        <td>{{ $estudante->data_nascimento }}</td>
                        <td>{{ $estudante->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum estudante matriculado nesta turma.</p>
    @endif
@endsection
