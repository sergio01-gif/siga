@extends('layouts.app')

@section('title', 'Criar Matrícula')

@section('content')
<div class="container">
    <h2 class="mb-4">Criar Nova Matrícula</h2>

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

    <form action="{{ route('matriculas.store') }}" method="POST">
        @csrf

        <!-- Estudante -->
        <div class="mb-3">
            <label for="estudante_id" class="form-label">Estudante</label>
            <select name="estudante_id" class="form-select" required>
                <option value="">Selecione o estudante</option>
                @foreach($estudantes as $estudante)
                    <option value="{{ $estudante->id }}" {{ old('estudante_id') == $estudante->id ? 'selected' : '' }}>
                        {{ $estudante->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Curso -->
        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso (opcional)</label>
            <select name="curso_id" class="form-select">
                <option value="">Selecione o curso</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Turma -->
        <div class="mb-3">
            <label for="turma_id" class="form-label">Turma</label>
            <select name="turma_id" class="form-select" required>
                <option value="">Selecione a turma</option>
                @foreach($turmas as $turma)
                    <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                        {{ $turma->nome }} - {{ $turma->anoAcademico->ano_inicio ?? '' }}/{{ $turma->anoAcademico->ano_fim ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Ano Académico -->
        <div class="mb-3">
            <label for="ano_academico_id" class="form-label">Ano Académico</label>
            <select name="ano_academico_id" class="form-select" required>
                <option value="">Selecione o ano académico</option>
                @foreach($anosAcademicos as $ano)
                    <option value="{{ $ano->id }}" {{ old('ano_academico_id') == $ano->id ? 'selected' : '' }}>
                        {{ $ano->ano_inicio }} - {{ $ano->ano_fim }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Data de Matrícula -->
        <div class="mb-3">
            <label for="data_matricula" class="form-label">Data da Matrícula</label>
            <input type="date" name="data_matricula" class="form-control"
                   value="{{ old('data_matricula', date('Y-m-d')) }}" required>
        </div>

        <!-- Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
                <option value="">Selecione o estado</option>
                <option value="ativo" {{ old('estado') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('estado') == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        <!-- Botões -->
        <button type="submit" class="btn btn-primary">Salvar Matrícula</button>
        <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
