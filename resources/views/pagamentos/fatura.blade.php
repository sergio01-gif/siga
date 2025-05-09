<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Fatura de Pagamento</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .cabecalho { text-align: center; margin-bottom: 20px; }
        .cabecalho img { height: 60px; }
        .cabecalho h1 { margin: 5px 0; }
        .dados, .detalhes { margin-bottom: 20px; }
        .dados td, .detalhes td { padding: 5px 10px; }
        .detalhes { border-top: 1px solid #000; border-bottom: 1px solid #000; }
        .assinatura { margin-top: 50px; }
    </style>
</head>
<body>

    <div class="cabecalho">
        @if($config?->logo)
            <img src="{{ public_path('storage/' . $config->logo) }}" alt="Logotipo">
        @endif
        <h1>{{ $config?->nome_instituicao ?? 'Instituição de Ensino' }}</h1>
        <h2>Fatura de Pagamento</h2>
    </div>

    <table class="dados">
        <tr><td><strong>Nome do Estudante:</strong></td><td>{{ $pagamento->estudante->nome }}</td></tr>
        <tr><td><strong>Telefone:</strong></td><td>{{ $pagamento->estudante->telefone }}</td></tr>
        <tr><td><strong>Referência:</strong></td><td>{{ $pagamento->referencia }}</td></tr>
        <tr><td><strong>Entidade:</strong></td><td>{{ $pagamento->entidade }}</td></tr>
        <tr><td><strong>Método:</strong></td><td>{{ strtoupper($pagamento->metodo) }}</td></tr>
        <tr><td><strong>Data de Pagamento:</strong></td><td>{{ $pagamento->data_pagamento ? \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y H:i') : '-' }}</td></tr>
    </table>

    <table class="detalhes" width="100%">
        <tr><td><strong>Descrição:</strong></td><td>{{ $pagamento->mensalidade->descricao ?? '-' }}</td></tr>
        <tr><td><strong>Valor Pago:</strong></td><td><strong>{{ number_format($pagamento->valor, 2) }} MZN</strong></td></tr>
        <tr><td><strong>Estado:</strong></td><td>{{ ucfirst($pagamento->estado) }}</td></tr>
    </table>

    <div class="assinatura">
        <p>_________________________</p>
        <p>Assinatura</p>
    </div>

</body>
</html>
