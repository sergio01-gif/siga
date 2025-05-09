@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Adicionar Receita</h2>

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

    <form action="{{ route('receitas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" class="form-control" placeholder="Ex: Mensalidade Abril" required>
        </div>

        <div class="form-group">
            <label for="valor">Valor (MZN):</label>
            <input type="number" name="valor" class="form-control" step="0.01" placeholder="Ex: 5000" required>
        </div>

        <div class="form-group">
            <label for="data_recebimento">Data de Recebimento:</label>
            <input type="date" name="data_recebimento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select name="categoria_id" class="form-control" required>
                <option value="">-- Selecionar --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="estudante_id">Estudante (Opcional):</label>
            <select name="estudante_id" class="form-control">
                <option value="">-- Selecione o estudante --</option>
                @foreach ($estudantes as $estudante)
                    <option value="{{ $estudante->id }}">{{ $estudante->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="observacao">Observação:</label>
            <textarea name="observacao" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        <a href="{{ route('receitas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection
