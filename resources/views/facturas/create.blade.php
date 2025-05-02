@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Emitir Nova Fatura</h2>

    <form action="{{ route('facturas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="estudante_id" class="form-label">Estudante</label>
            <select name="estudante_id" id="estudante_id" class="form-select" required>
                <option value="">-- Selecione --</option>
                @foreach($estudantes as $estudante)
                    <option value="{{ $estudante->id }}" {{ $estudanteSelecionado == $estudante->id ? 'selected' : '' }}>
                        {{ $estudante->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="valor_pago" class="form-label">Valor Pago (MZN)</label>
            <input type="number" name="valor_pago" id="valor_pago" class="form-control" required step="0.01" min="0">
        </div>

        <button type="submit" class="btn btn-primary">Emitir Fatura</button>
    </form>
</div>
@endsection
