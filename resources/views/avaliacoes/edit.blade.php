@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Avaliação</h1>

    <form action="{{ route('avaliacoes.update', $avaliacao->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nome">Nome da Avaliação</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $avaliacao->nome }}" required>
        </div>

        <div class="form-group">
            <label for="cadeira_id">Cadeira</label>
            <select class="form-control" id="cadeira_id" name="cadeira_id" required>
                @foreach ($cadeiras as $cadeira)
                    <option value="{{ $cadeira->id }}" {{ $cadeira->id == $avaliacao->cadeira_id ? 'selected' : '' }}>
                        {{ $cadeira->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="turma_id">Turma</label>
            <select class="form-control" id="turma_id" name="turma_id" required>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}" {{ $turma->id == $avaliacao->turma_id ? 'selected' : '' }}>
                        {{ $turma->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="data_avaliacao">Data da Avaliação</label>
            <input type="date" class="form-control" id="data_avaliacao" name="data_avaliacao" value="{{ $avaliacao->data_avaliacao->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="peso">Peso</label>
            <input type="number" class="form-control" id="peso" name="peso" value="{{ $avaliacao->peso }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Atualizar</button>
    </form>
</div>
@endsection
