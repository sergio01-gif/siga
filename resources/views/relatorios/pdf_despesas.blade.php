<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Despesas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Relatório de Despesas</h1>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($despesas as $despesa)
            <tr>
                <td>{{ \Carbon\Carbon::parse($despesa->data)->format('d/m/Y') }}</td>
                <td>{{ $despesa->descricao }}</td>
                <td>{{ $despesa->categoria->nome ?? 'Sem categoria' }}</td>
                <td>{{ number_format($despesa->valor, 2, ',', '.') }} MZN</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
