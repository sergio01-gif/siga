<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Receitas</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            margin: 20px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #000; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #f2f2f2; 
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Relatório de Receitas</h2>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Valor (MZN)</th>
                <th>Estudante</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receitas as $receita)
            <tr>
                <!-- Exibindo a Data -->
                <td>{{ \Carbon\Carbon::parse($receita->data_recebimento)->format('d/m/Y') }}</td>

                <!-- Exibindo a Categoria -->
                <td>{{ $receita->categoria->nome ?? 'Sem Categoria' }}</td>

                <!-- Exibindo a Descrição -->
                <td>{{ $receita->descricao }}</td>

                <!-- Exibindo o Valor -->
                <td>{{ number_format($receita->valor, 2, ',', '.') }} MZN</td>

                <!-- Exibindo o Estudante -->
                <td>{{ $receita->estudante->nome ?? 'Sem Estudante' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
