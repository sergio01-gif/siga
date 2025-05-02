@extends('layouts.app')

@section('title', 'Editar Matrícula')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Matrícula</h2>

    <!-- Exibição de erros -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Verifique os campos abaixo:<br><br>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário para editar matrícula -->
    <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="estudante_id">Estudante</label>
            <select class="form-control" id="estudante_id" name="estudante_id" required>
                @foreach ($estudantes as $estudante)
                    <option value="{{ $estudante->id }}" {{ $matricula->estudante_id == $estudante->id ? 'selected' : '' }}>
                        {{ $estudante->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="turma_id">Turma</label>
            <select class="form-control" id="turma_id" name="turma_id" required>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}" {{ $matricula->turma_id == $turma->id ? 'selected' : '' }}>
                        {{ $turma->nome }} - {{ $turma->anoAcademico->ano_inicio ?? '' }}/{{ $turma->anoAcademico->ano_fim ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ano_academico_id">Ano Acadêmico</label>
            <select class="form-control" id="ano_academico_id" name="ano_academico_id" required>
                @foreach ($anosAcademicos as $anoAcademico)
                    <option value="{{ $anoAcademico->id }}" {{ $matricula->ano_academico_id == $anoAcademico->id ? 'selected' : '' }}>
                        {{ $anoAcademico->ano_inicio }} - {{ $anoAcademico->ano_fim }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="curso_id">Curso</label>
            <select class="form-control" id="curso_id" name="curso_id" required>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ $matricula->curso_id == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="data_matricula">Data da Matrícula</label>
            <input type="date" class="form-control" id="data_matricula" name="data_matricula" value="{{ old('data_matricula', $matricula->data_matricula->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="ativo" {{ $matricula->estado == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ $matricula->estado == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Atualizar Matrícula</button>
    </form>

    <!-- Voltar -->
    <a href="{{ route('matriculas.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
