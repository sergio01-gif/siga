@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Receita</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Existem alguns problemas.<br><br>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('receitas.update', $receita->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" value="{{ $receita->descricao }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="valor">Valor (MZN):</label>
            <input type="number" name="valor" value="{{ $receita->valor }}" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="data_recebimento">Data de Recebimento:</label>
            <input type="date" name="data_recebimento" value="{{ $receita->data_recebimento }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" value="{{ $receita->categoria }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="estudante_id">Estudante (Opcional):</label>
            <select name="estudante_id" class="form-control">
                <option value="">-- Nenhum --</option>
                @foreach ($estudantes as $estudante)
                    <option value="{{ $estudante->id }}" {{ $receita->estudante_id == $estudante->id ? 'selected' : '' }}>
                        {{ $estudante->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="observacao">Observação:</label>
            <textarea name="observacao" class="form-control" rows="3">{{ $receita->observacao }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Atualizar</button>
        <a href="{{ route('receitas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection
