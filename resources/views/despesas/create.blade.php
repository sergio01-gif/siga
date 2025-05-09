@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nova Despesa</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Corrija os seguintes problemas:<br><br>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('despesas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" step="0.01" name="valor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="data_pagamento" class="form-label">Data de Pagamento</label>
            <input type="date" name="data_pagamento" class="form-control">
        </div>

        <div class="mb-3">
            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
            <select name="forma_pagamento" class="form-control" required>
                <option value="">-- Selecionar --</option>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Mpesa">Mpesa</option>
                <option value="Banco">Banco</option>
            </select>
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

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pago">Pago</option>
                <option value="pendente">Pendente</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Despesa</button>
    </form>
</div>
@endsection
