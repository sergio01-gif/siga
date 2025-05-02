@extends('layouts.app') <!-- Ou o nome do layout base do seu projeto -->

@section('content')
<div class="container">
    <h1>Lista de Matrículas</h1>

    <!-- Exibição de mensagens de sucesso ou erro -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tabela de Matrículas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Estudante</th>
                <th>Curso</th>
                <th>Turma</th>
                <th>Ano Acadêmico</th>
                <th>Data de Matrícula</th>
                <th>Estado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->estudante->nome ?? 'N/A' }}</td>
                    <td>{{ $matricula->curso->nome ?? 'N/A' }}</td>
                    <td>{{ $matricula->turma->nome ?? 'N/A' }}</td>
                    <td>{{ $matricula->turma->nome }} - {{ $matricula->turma->anoAcademico->ano_inicio ?? '' }}/{{ $matricula->turma->anoAcademico->ano_fim ?? '' }}</td>
                    <td>{{ $matricula->anoAcademico ? $matricula->anoAcademico->ano_inicio . ' - ' . $matricula->anoAcademico->ano_fim : 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($matricula->data_matricula)->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($matricula->estado) }}</td>
                    <td>
                        <a href="{{ route('matriculas.show', $matricula->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja remover esta matrícula?')">Remover</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botão para criar nova matrícula -->
    <a href="{{ route('matriculas.create') }}" class="btn btn-success">Nova Matrícula</a>
</div>
@endsection
