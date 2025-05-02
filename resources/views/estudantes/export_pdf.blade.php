<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Alunos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Relatório de Alunos</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Gênero</th>
                <th>Curso</th>
                <th>Ano Letivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->nome }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->telefone }}</td>
                    <td>{{ $student->data_nascimento }}</td>
                    <td>{{ $student->genero }}</td>
                    <td>{{ $student->course->nome }}</td>
                    <td>{{ $student->ano_lectivo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
