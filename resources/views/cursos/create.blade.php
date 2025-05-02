@extends('layouts.app')

@section('content')
    <h1>Cadastrar Novo Curso</h1>

    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome do Curso</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="codigo">Código do Curso</label>
            <input type="text" name="codigo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="duracao">Duração (anos)</label>
            <input type="number" name="duracao" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Salvar</button>
    </form>
@endsection
