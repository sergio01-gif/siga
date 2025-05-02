@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Criar Anúncio</h2>

    <form method="POST" action="{{ route('anuncios.store') }}">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
        </div>

        <div class="mb-3">
            <label for="conteudo" class="form-label">Conteúdo</label>
            <textarea name="conteudo" class="form-control" rows="4" required>{{ old('conteudo') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="destinatarios" class="form-label">Destinatários</label>
            <select name="destinatarios" class="form-select" required>
                <option value="todos">Todos</option>
                <option value="estudantes">Estudantes</option>
                <option value="professores">Professores</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="data_publicacao" class="form-label">Data de Publicação</label>
            <input type="date" name="data_publicacao" class="form-control" value="{{ old('data_publicacao', date('Y-m-d')) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Publicar Anúncio</button>
    </form>
</div>
@endsection
