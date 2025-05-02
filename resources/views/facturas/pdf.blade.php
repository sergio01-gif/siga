<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fatura {{ $factura->numero_factura }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .info { margin-bottom: 15px; }
        .info b { display: inline-block; width: 150px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Recibo de Pagamento</h2>
        <p>Número: {{ $factura->numero_factura }}</p>
    </div>

    <div class="info">
        <p><b>Estudante:</b> {{ $factura->estudante->nome }}</p>
        <p><b>Data Pagamento:</b> {{ \Carbon\Carbon::parse($factura->data_pagamento)->format('d/m/Y') }}</p>
        <p><b>Forma de Pagamento:</b> {{ $factura->forma_pagamento }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor Pago</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mensalidade: {{ $factura->mensalidade->descricao ?? '---' }}</td>
                <td>{{ number_format($factura->valor_pago, 2, ',', '.') }} MZN</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 40px;">Assinatura ____________________________</p>
</body>
</html>
