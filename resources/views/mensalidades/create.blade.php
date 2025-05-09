@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Criar Mensalidade</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('mensalidades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="estudante_id" class="form-label">Estudante</label>
            <select name="estudante_id" id="estudante_id" class="form-control" required>
                <option value="">-- Selecione o Estudante --</option>
                @foreach($estudantes as $estudante)
                    <option value="{{ $estudante->id }}">{{ $estudante->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
    <label for="mes_referencia" class="form-label">Mês de Referência</label>
    <select name="mes_referencia" id="mes_referencia" class="form-control" required>
        <option value="">-- Selecione o mês --</option>
        @foreach(['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'] as $mes)
            <option value="{{ $mes }}">{{ $mes }}</option>
        @endforeach
    </select>
</div>

        <div class="mb-3">
            <label for="data_vencimento" class="form-label">Data de Vencimento</label>
            <input type="date" name="data_vencimento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor (MZN)</label>
            <input type="number" name="valor" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-control">
                <option value="pendente">Pendente</option>
                <option value="pago">Pago</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Criar Mensalidade</button>
    </form>
</div>
@endsection
