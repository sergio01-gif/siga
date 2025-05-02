@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Despesas</h1>

    <a href="{{ route('despesas.create') }}" class="btn btn-primary mb-3">Adicionar Despesa</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Pagamento</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($despesas as $despesa)
            <tr>
                <td>{{ $despesa->id }}</td>
                <td>{{ $despesa->descricao }}</td>
                <td>{{ number_format($despesa->valor, 2, ',', '.') }} MZN</td>
                <td>{{ \Carbon\Carbon::parse($despesa->data_pagamento)->format('d/m/Y') }}</td>
                <td>{{ $despesa->categoria }}</td>
                <td>
                    <a href="{{ route('despesas.edit', $despesa) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('despesas.destroy', $despesa) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja eliminar esta despesa?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
