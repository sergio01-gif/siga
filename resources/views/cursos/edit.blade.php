@extends('layouts.app')

@section('content')
    <h1>Editar Curso</h1>

    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nome">Nome do Curso</label>
            <input type="text" name="nome" class="form-control" value="{{ $curso->nome }}" required>
        </div>
        <div class="form-group">
            <label for="codigo">Código do Curso</label>
            <input type="text" name="codigo" class="form-control" value="{{ $curso->codigo }}" required>
        </div>
        <div class="form-group">
            <label for="duracao">Duração (anos)</label>
            <input type="number" name="duracao" class="form-control" value="{{ $curso->duracao }}" required>
        </div>
        <button type="submit" class="btn btn-warning mt-3">Atualizar</button>
    </form>
@endsection
