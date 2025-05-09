<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Estudantes</title>
    <style>
        body { font-family: sans-serif; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: left; }
        .logo { height: 60px; }
        .cabecalho { text-align: center; margin-bottom: 10px; }
        .cabecalho h2, .cabecalho p { margin: 3px 0; }
    </style>
</head>
<body>
    <div class="cabecalho">
        @if($config?->logo)
            <img src="{{ public_path('storage/' . $config->logo) }}" class="logo">
        @endif
        <h2>{{ $config?->nome_instituicao ?? 'Instituição' }}</h2>
        <p><strong>Curso:</strong> {{ $curso->nome ?? '-' }} | <strong>Turma:</strong> {{ $turma->nome ?? '-' }}</p>
        <p><strong>Data:</strong> {{ $dataExportacao }} | <strong>Usuário:</strong> {{ $usuario->name ?? '-' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Documento</th>
                <th>Curso</th>
                <th>Turma</th>
                <th>Ano</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudantes as $estudante)
                <tr>
                    <td>{{ $estudante->nome }}</td>
                    <td>{{ $estudante->email }}</td>
                    <td>{{ $estudante->telefone }}</td>
                    <td>{{ $estudante->tipo_documento }} - {{ $estudante->numero_documento }}</td>
                    <td>{{ $estudante->curso->nome ?? '-' }}</td>
                    <td>{{ $estudante->turma->nome ?? '-' }}</td>
                    <td>{{ $estudante->ano_lectivo->nome ?? '-' }}</td>
                    <td>{{ ucfirst($estudante->estado) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
