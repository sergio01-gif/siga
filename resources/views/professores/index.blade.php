<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Professores</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Lista de Professores</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Especialidade</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($professores as $p)
                <tr>
                    <td>{{ $p->nome }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->telefone }}</td>
                    <td>{{ $p->especialidade }}</td>
                    <td>{{ ucfirst($p->tipo_contratacao) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
