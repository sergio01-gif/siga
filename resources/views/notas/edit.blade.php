@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Nota</h1>

    <form action="{{ route('notas.update', $nota->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="avaliacao_id">Avaliação</label>
            <select class="form-control" id="avaliacao_id" name="avaliacao_id" required>
                @foreach ($avaliacoes as $avaliacao)
                    <option value="{{ $avaliacao->id }}" {{ $avaliacao->id == $nota->avaliacao_id ? 'selected' : '' }}>
                        {{ $avaliacao->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="estudante_id">Estudante</label>
            <select class="form-control" id="estudante_id" name="estudante_id" required>
                @foreach ($estudantes as $estudante)
                    <option value="{{ $estudante->id }}" {{ $estudante->id == $nota->estudante_id ? 'selected' : '' }}>
                        {{ $estudante->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nota">Nota</label>
            <input type="number" class="form-control" id="nota" name="nota" value="{{ $nota->nota }}" required>
        </div>

        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea class="form-control" id="observacao" name="observacao" rows="3">{{ $nota->observacao }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Atualizar</button>
    </form>
</div>
@endsection
