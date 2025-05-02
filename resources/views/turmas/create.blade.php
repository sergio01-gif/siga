@extends('layouts.app') <!-- Ou outro layout base que você usa -->

@section('title', 'Criar Nova Turma')

@section('content')
<div class="container">
    <h2 class="mb-4">Criar Nova Turma</h2>

    <!-- Mensagens de erro -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Verifique os campos obrigatórios abaixo.<br><br>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário de criação -->
    <form action="{{ route('turmas.store') }}" method="POST">
        @csrf

        <!-- Nome da Turma -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Turma</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <!-- Curso -->
        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso</label>
            <select name="curso_id" class="form-select" required>
                <option value="">Selecione um curso</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>

       <!-- Ano Académico -->
<div class="mb-3">
    <label for="ano_academico_id" class="form-label">Ano Académico</label>
    <select name="ano_academico_id" class="form-select" required>
        <option value="">Selecione o ano académico</option>
        @foreach($anoAcademicos as $ano)
            <option value="{{ $ano->id }}" {{ old('ano_academico_id') == $ano->id ? 'selected' : '' }}>
                {{ $ano->ano_inicio }} - {{ $ano->ano_fim }}
            </option>
        @endforeach
    </select>
</div

        <!-- Botões -->
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('turmas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
