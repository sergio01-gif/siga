@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registar Pagamento de Mensalidade</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('mensalidades.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="estudante_id">Estudante</label>
            <select name="estudante_id" id="estudante_id" class="form-control" required>
                <option value="">-- Selecione o Estudante --</option>
                @foreach ($estudantes as $estudante)
                    <option value="{{ $estudante->id }}" {{ old('estudante_id') == $estudante->id ? 'selected' : '' }}>
                        {{ $estudante->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="mes_referencia">Mês de Pagamento</label>
            <select name="mes_referencia" id="mes_referencia" class="form-control" required>
                <option value="">-- Selecione o Mês --</option>
                @foreach ([
                    'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ] as $mes)
                    <option value="{{ $mes }}" {{ old('mes_referencia') == $mes ? 'selected' : '' }}>
                        {{ $mes }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="data_vencimento">Data de Vencimento</label>
            <input type="date" name="data_vencimento" id="data_vencimento" class="form-control" value="{{ old('data_vencimento') }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="valor">Valor</label>
            <input type="number" name="valor" id="valor" class="form-control" value="{{ old('valor') }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="forma_pagamento">Forma de Pagamento</label>
            <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
                <option value="">-- Selecione a Forma de Pagamento --</option>
                <option value="dinheiro" {{ old('forma_pagamento') == 'dinheiro' ? 'selected' : '' }}>
                    💵 Dinheiro
                </option>
                <option value="mpesa" {{ old('forma_pagamento') == 'mpesa' ? 'selected' : '' }}>
                    📱 M-Pesa
                </option>
                <option value="emola" {{ old('forma_pagamento') == 'emola' ? 'selected' : '' }}>
                    📱 E-Mola
                </option>
                <option value="cartao" {{ old('forma_pagamento') == 'cartao' ? 'selected' : '' }}>
                    💳 Cartão (Visa/Mastercard)
                </option>
                <option value="transferencia" {{ old('forma_pagamento') == 'transferencia' ? 'selected' : '' }}>
                    🔄 Transferência Bancária
                </option>
                <option value="entidade_referencia" {{ old('forma_pagamento') == 'entidade_referencia' ? 'selected' : '' }}>
                    🏦 Entidade de Referência
                </option>
            </select>
        </div>

        <div id="entidade_referencia_div" class="form-group mt-3" style="display: none;">
            <label for="entidade_referencia">Entidade de Referência</label>
            <input type="text" id="entidade_referencia" name="entidade_referencia" class="form-control" value="{{ old('entidade_referencia') }}" readonly>
            <small class="form-text text-muted">Utilize este código para pagamento em bancos ou caixas automáticos.</small>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salvar Pagamento</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var formaPagamento = document.getElementById('forma_pagamento');
        var entidadeReferenciaDiv = document.getElementById('entidade_referencia_div');
        var entidadeReferenciaInput = document.getElementById('entidade_referencia');

        formaPagamento.addEventListener('change', function() {
            if (this.value === 'entidade_referencia') {
                entidadeReferenciaDiv.style.display = 'block';
                entidadeReferenciaInput.value = gerarEntidadeReferencia();
            } else {
                entidadeReferenciaDiv.style.display = 'none';
                entidadeReferenciaInput.value = '';
            }
        });

        function gerarEntidadeReferencia() {
            const entidade = '34567'; 
            const referencia = Math.floor(100000000 + Math.random() * 900000000);
            return entidade + referencia;
        }
    });
</script>
@endsection
