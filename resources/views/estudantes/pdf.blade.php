<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Alunos</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 60px;
        }
        .university-info {
            text-align: center;
            margin-top: 10px;
        }
        .export-info, .filters-info {
            font-size: 11px;
            margin-bottom: 5px;
        }
        .export-info {
            text-align: right;
        }
        .filters-info {
            text-align: left;
        }
        h2 {
            text-align: center;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    {{-- Cabeçalho com logotipo --}}
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logotipo da Universidade">
        <div class="university-info">
            <strong>Instituto Médio Politécnico Macequece</strong><br>
            Rua 25 de Setembro, Manica - Moçambique<br>
            Tel: +258 86 490 4273 | Email: info@impom.co.mz
        </div>
    </div>

    {{-- Informações de filtros --}}
    <div class="filters-info">
        Curso: <strong>{{ $curso->nome ?? 'Todos os Cursos' }}</strong><br>
        Ano Lectivo: <strong>{{ $anoLectivo ?? 'Todos os Anos' }}</strong>
    </div>

    {{-- Informação de exportação --}}
    <div class="export-info">
        Exportado por: <strong>{{ auth()->user()->name }}</strong><br>
        Data: {{ now()->format('d/m/Y H:i') }}
    </div>

    {{-- Título --}}
    <h2>Lista de Alunos</h2>

    {{-- Tabela --}}
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Curso</th>  {{-- Adicionado Curso aqui --}}
            </tr>
        </thead>
        <tbody>
            @foreach($estudantes as $estudante)
                <tr>
                    <td>{{ $estudante->nome }}</td>
                    <td>{{ $estudante->email }}</td>
                    <td>{{ $estudante->telefone }}</td>
                    <td>{{ \Carbon\Carbon::parse($estudante->data_nascimento)->format('d/m/Y') }}</td>
                    <td>{{ $estudante->curso->nome ?? 'Sem Curso' }}</td>  {{-- Adicionado o campo do Curso --}}
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
