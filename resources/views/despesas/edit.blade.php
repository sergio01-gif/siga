@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Despesa</h1>

    <form action="{{ route('despesas.update', $despesa) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $despesa->descricao }}" required>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor (MZN)</label>
            <input type="number" class="form-control" id="valor" name="valor" step="0.01" value="{{ $despesa->valor }}" required>
        </div>

        <div class="mb-3">
            <label for="data_pagamento" class="form-label">Data de Pagamento</label>
            <input type="date" class="form-control" id="data_pagamento" name="data_pagamento" value="{{ $despesa->data_pagamento }}" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" class="form-control" id="categoria" name="categoria" value="{{ $despesa->categoria }}">
        </div>

        <div class="mb-3">
            <label for="observacao" class="form-label">Observação</label>
            <textarea class="form-control" id="observacao" name="observacao" rows="3">{{ $despesa->observacao }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection
