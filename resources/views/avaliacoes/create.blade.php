@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Avaliação</h1>

    <form action="{{ route('avaliacoes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome da Avaliação</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="cadeira_id">Cadeira</label>
            <select class="form-control" id="cadeira_id" name="cadeira_id" required>
                @foreach ($cadeiras as $cadeira)
                    <option value="{{ $cadeira->id }}">{{ $cadeira->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="turma_id">Turma</label>
            <select class="form-control" id="turma_id" name="turma_id" required>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="data_avaliacao">Data da Avaliação</label>
            <input type="date" class="form-control" id="data_avaliacao" name="data_avaliacao" required>
        </div>

        <div class="form-group">
            <label for="peso">Peso</label>
            <input type="number" class="form-control" id="peso" name="peso" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar</button>
    </form>
</div>
@endsection
