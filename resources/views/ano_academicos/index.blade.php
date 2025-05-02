@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Anos Acadêmicos</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Ano de Início</th>
                    <th>Ano de Fim</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anoAcademicos as $anoAcademico)
                    <tr>
                        <td>{{ $anoAcademico->ano_inicio }}</td>
                        <td>{{ $anoAcademico->ano_fim }}</td>
                        <td>
                        <a href="{{ route('ano_academicos.turmas', $anoAcademico->id) }}" class="btn btn-info">Ver Turmas</a>
                            <a href="{{ route('ano_academicos.edit', $anoAcademico) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('ano_academicos.destroy', $anoAcademico) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('ano_academicos.create') }}" class="btn btn-primary">Novo Ano Acadêmico</a>
    </div>
@endsection
