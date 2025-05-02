@extends('layouts.app')

@section('title', 'Nova Cadeira')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Cadastrar Nova Cadeira</h2>

    <form action="{{ route('cadeiras.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Cadeira</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" id="nome" value="{{ old('nome') }}" required>
            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="carga_horaria" class="form-label">Carga Horária (horas)</label>
            <input type="number" class="form-control @error('carga_horaria') is-invalid @enderror" name="carga_horaria" id="carga_horaria" value="{{ old('carga_horaria') }}" required>
            @error('carga_horaria') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="semestre" class="form-label">Semestre</label>
            <input type="number" class="form-control @error('semestre') is-invalid @enderror" name="semestre" id="semestre" value="{{ old('semestre') }}" required>
            @error('semestre') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control @error('descricao') is-invalid @enderror" name="descricao" id="descricao" rows="3">{{ old('descricao') }}</textarea>
            @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select @error('estado') is-invalid @enderror" name="estado" id="estado" required>
                <option value="">-- Selecione --</option>
                <option value="ativo" {{ old('estado') == 'ativo' ? 'selected' : '' }}>ativo</option>
                <option value="inativo" {{ old('estado') == 'inativo' ? 'selected' : '' }}>inativo</option>
            </select>
            @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Cursos Associados</label>
            <select class="form-select @error('curso_id') is-invalid @enderror" name="curso_id[]" id="curso_id" multiple required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ in_array($curso->id, old('curso_id', [])) ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
            @error('curso_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('cadeiras.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
