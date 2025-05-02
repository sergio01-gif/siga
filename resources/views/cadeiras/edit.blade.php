@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Cadeira</h1>

    <form action="{{ route('cadeiras.update', $cadeira->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Cadeira</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $cadeira->nome }}" required>
        </div>

        <div class="mb-3">
    <label for="curso_id" class="form-label">Cursos</label>
    <select class="form-control" id="curso_id" name="curso_id[]" multiple required>
        @foreach($cursos as $curso)
            <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
        @endforeach
    </select>
</div>

        <div class="mb-3">
            <label for="carga_horaria" class="form-label">Carga Horária (horas)</label>
            <input type="number" class="form-control" id="carga_horaria" name="carga_horaria" value="{{ $cadeira->carga_horaria }}" required>
        </div>

        <div class="mb-3">
            <label for="semestre" class="form-label">Semestre</label>
            <input type="number" class="form-control" id="semestre" name="semestre" value="{{ $cadeira->semestre }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4">{{ $cadeira->descricao }}</textarea>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="Ativo" {{ $cadeira->estado == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="Inativo" {{ $cadeira->estado == 'Inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('cadeiras.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
