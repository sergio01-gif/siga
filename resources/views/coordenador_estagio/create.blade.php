@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-white mb-4">Novo Estágio</h1>

    <form action="{{ route('estagios.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label text-white">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Estudante</label>
            <select name="estudante_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($estudantes as $estudante)
                    <option value="{{ $estudante->id }}">{{ $estudante->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Data de Início</label>
            <input type="date" name="data_inicio" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Data de Fim</label>
            <input type="date" name="data_fim" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('estagios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
