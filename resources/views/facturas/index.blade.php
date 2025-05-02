@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Faturas Emitidas</h2>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Estudante</th>
                <th>Valor Pago</th>
                <th>Data</th>
                <th>Numero Fatura</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $fatura)
            <tr>
                <td>{{ $fatura->id }}</td>
                <td>{{ $fatura->estudante->nome }}</td>
                <td>{{ number_format($fatura->valor_pago, 2, ',', '.') }}</td>
                <td>{{ $fatura->created_at->format('d/m/Y') }}</td>
                <td>{{ $fatura->numero_fatura }}</td>
                <td>
                    <a href="{{ route('facturas.show', $fatura->id) }}" class="btn btn-info btn-sm">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
