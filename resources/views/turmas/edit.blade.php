@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Turma</h2>

    <form action="{{ route('turmas.update', $turma->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo Nome da Turma -->
        <div class="form-group">
            <label for="nome">Nome da Turma</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $turma->nome }}" required>
        </div>

        <!-- Campo Seleção de Curso -->
        <div class="form-group">
            <label for="curso_id">Curso</label>
            <select class="form-control" id="curso_id" name="curso_id" required>
                <option value="">Selecione o Curso</option>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}" @if($curso->id == $turma->curso_id) selected @endif>{{ $curso->nome }}</option>
                @endforeach
            </select>
        </div>

      <!-- Campo Seleção de Ano Acadêmico -->
<div class="form-group">
    <label for="ano_academico_id">Ano Acadêmico</label>
    <select class="form-control" id="ano_academico_id" name="ano_academico_id" required>
        <option value="">Selecione o Ano Acadêmico</option>
        @foreach ($anoAcademicos as $anoAcademico)
            <option value="{{ $anoAcademico->id }}" 
                @if($anoAcademico->id == $turma->ano_academico_id) selected @endif>
                {{ $anoAcademico->ano_inicio }} - {{ $anoAcademico->ano_fim }}
            </option>
        @endforeach
    </select>
</div>


        <!-- Botão para Submeter o Formulário -->
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
