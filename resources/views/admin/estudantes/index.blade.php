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
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-[#0072CE] mb-4">Estudantes</h1>

    {{-- Filtros --}}
    <form method="GET" class="mb-6 bg-white p-4 rounded shadow flex flex-wrap gap-4">
        <input type="text" name="nome" placeholder="Buscar por nome" value="{{ request('nome') }}"
               class="px-3 py-2 border rounded w-full md:w-1/3">

        <select name="curso_id" class="px-3 py-2 border rounded w-full md:w-1/3">
            <option value="">-- Todos os Cursos --</option>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                    {{ $curso->nome }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-[#0072CE] text-white px-4 py-2 rounded">Filtrar</button>
    </form>

    {{-- Tabela --}}
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Telefone</th>
                    <th class="px-4 py-2">Curso</th>
                    <th class="px-4 py-2">Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($estudantes as $estudante)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $estudante->nome }}</td>
                        <td class="px-4 py-2">{{ $estudante->email }}</td>
                        <td class="px-4 py-2">{{ $estudante->telefone }}</td>
                        <td class="px-4 py-2">{{ $estudante->curso->nome ?? '-' }}</td>
                        <td class="px-4 py-2 capitalize">{{ $estudante->estado }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-4 text-center text-gray-500">Nenhum estudante encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    <div class="mt-4">
        {{ $estudantes->withQueryString()->links() }}
    </div>
</div>
@endsection
