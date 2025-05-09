<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Professores</title>
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
        <p><strong>Data:</strong> {{ $dataExportacao }} | <strong>Usuário:</strong> {{ $usuario->name ?? '-' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Documento</th>
                <th>Especialidade</th>
                <th>Tipo de Contratação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($professores as $p)
                <tr>
                    <td>{{ $p->nome }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->telefone }}</td>
                    <td>{{ $p->documento_identificacao }}</td>
                    <td>{{ $p->especialidade }}</td>
                    <td>{{ ucfirst($p->tipo_contratacao) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
