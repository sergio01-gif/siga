@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Estudante</h2>

    <form action="{{ route('estudantes.update', $estudante->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome Completo</label>
            <input type="text" name="nome" class="form-control" value="{{ $estudante->nome }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ $estudante->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="{{ $estudante->telefone }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Curso</label>
            <select name="curso_id" class="form-select" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ $estudante->curso_id == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('estudantes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
