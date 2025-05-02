@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Nota</h1>

    <form action="{{ route('notas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="avaliacao_id">Avaliação</label>
            <select class="form-control" id="avaliacao_id" name="avaliacao_id" required>
                @foreach ($avaliacoes as $avaliacao)
                    <option value="{{ $avaliacao->id }}">{{ $avaliacao->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="estudante_id">Estudante</label>
            <select class="form-control" id="estudante_id" name="estudante_id" required>
                @foreach ($estudantes as $estudante)
                    <option value="{{ $estudante->id }}">{{ $estudante->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nota">Nota</label>
            <input type="number" class="form-control" id="nota" name="nota" required>
        </div>

        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar</button>
    </form>
</div>
@endsection
