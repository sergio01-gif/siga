@extends('layouts.app') <!-- Ou o nome do layout base do seu projeto -->

@section('content')
<div class="container">
    <h1>Criar Nova Matrícula</h1>

    <!-- Exibição de mensagens de erro -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário para criação de matrícula -->
    <form action="{{ route('matriculas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="estudante_id" class="form-label">Estudante</label>
            <select name="estudante_id" id="estudante_id" class="form-control" required>
                <option value="">Selecione o Estudante</option>
                @foreach ($estudantes as $estudante)
                    <option value="{{ $estudante->id }}" {{ old('estudante_id') == $estudante->id ? 'selected' : '' }}>
                        {{ $estudante->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso</label>
            <select name="curso_id" id="curso_id" class="form-control" required>
                <option value="">Selecione o Curso</option>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="turma_id" class="form-label">Turma</label>
            <select name="turma_id" id="turma_id" class="form-control" required>
                <option value="">Selecione a Turma</option>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                        {{ $turma->nome }} ({{ $turma->anoAcademico->ano }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ano_academico_id" class="form-label">Ano Acadêmico</label>
            <select name="ano_academico_id" id="ano_academico_id" class="form-control" required>
                <option value="">Selecione o Ano Acadêmico</option>
                @foreach ($anosAcademicos as $anoAcademico)
                    <option value="{{ $anoAcademico->id }}" {{ old('ano_academico_id') == $anoAcademico->id ? 'selected' : '' }}>
                        {{ $anoAcademico->ano }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="data_matricula" class="form-label">Data de Matrícula</label>
            <input type="date" name="data_matricula" id="data_matricula" class="form-control" value="{{ old('data_matricula') }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="ativo" {{ old('estado') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('estado') == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Criar Matrícula</button>
        <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
