<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Resumo do Dashboard</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>

    <h1>Resumo do Sistema - Dashboard</h1>

    <table>
        <tr>
            <th>Indicador</th>
            <th>Valor</th>
        </tr>
        <tr><td>Total de Cursos</td><td>{{ $totalCursos }}</td></tr>
        <tr><td>Total de Estudantes</td><td>{{ $totalEstudantes }}</td></tr>
        <tr><td>Total de Professores</td><td>{{ $totalProfessores }}</td></tr>
        <tr><td>Total de Estágios</td><td>{{ $totalEstagios }}</td></tr>
        <tr><td>Total de Faturas</td><td>{{ $totalFaturas }}</td></tr>
        <tr><td>Total de Livros</td><td>{{ $totalLivros }}</td></tr>
        <tr><td>Total de Mensalidades</td><td>{{ $totalMensalidades }}</td></tr>
        <tr><td>Mensalidades Pagas</td><td>{{ $mensalidadesPagas }}</td></tr>
        <tr><td>Mensalidades em Dívida</td><td>{{ $mensalidadesPendentes }}</td></tr>
    </table>

    <p style="margin-top: 20px;">Data: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

</body>
</html>
