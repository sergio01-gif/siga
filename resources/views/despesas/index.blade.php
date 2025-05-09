@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Despesas</h2>
        <a href="{{ route('despesas.create') }}" class="btn btn-success">+ Nova Despesa</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($despesas->count())
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data de Pagamento</th>
                    <th>Forma de Pagamento</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($despesas as $index => $despesa)
                    <tr>
                        <td>{{ $loop->iteration + ($despesas->currentPage() - 1) * $despesas->perPage() }}</td>
                        <td>{{ $despesa->descricao }}</td>
                        <td>{{ number_format($despesa->valor, 2, ',', '.') }} MZN</td>
                        <td>{{ \Carbon\Carbon::parse($despesa->data_pagamento)->format('d/m/Y') }}</td>
                        <td>{{ $despesa->forma_pagamento }}</td>
                        <td>{{ $despesa->categoria->nome ?? '—' }}</td>
                        <td>
                            <span class="badge bg-{{ $despesa->status == 'pago' ? 'success' : 'warning' }}">
                                {{ ucfirst($despesa->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('despesas.edit', $despesa->id) }}" class="btn btn-sm btn-primary">Editar</a>

                            <form action="{{ route('despesas.destroy', $despesa->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Deseja mesmo excluir esta despesa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $despesas->links() }} {{-- Paginação --}}
    @else
        <div class="alert alert-info">Nenhuma despesa cadastrada ainda.</div>
    @endif
</div>
@endsection
