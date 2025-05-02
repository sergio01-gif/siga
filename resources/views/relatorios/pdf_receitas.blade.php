<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Receitas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Relatório de Receitas</h2>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Valor (MZN)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receitas as $receita)
            <tr>
                <td>{{ \Carbon\Carbon::parse($receita->data)->format('d/m/Y') }}</td>
                <td>{{ $receita->descricao }}</td>
                <td>{{ $receita->categoria->nome ?? 'Sem categoria' }}</td>
                <td>{{ number_format($receita->valor, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
