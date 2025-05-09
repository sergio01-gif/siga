@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-white mb-4">Estágios</h1>

    <a href="{{ route('coordenador_estagio.create') }}" class="btn btn-primary mb-3">Novo Estágio</a>

    @if(session('success'))
        <div class="alert alert-success text-dark">{{ session('success') }}</div>
    @endif

    <div class="card bg-dark text-white">
        <div class="card-body p-0">
            <table class="table table-dark table-hover mb-0">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Estudante</th>
                        <th>Status</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estagios as $estagio)
                        <tr>
                            <td>{{ $estagio->titulo }}</td>
                            <td>{{ $estagio->estudante->nome ?? '-' }}</td>
                            <td>{{ ucfirst($estagio->status) }}</td>
                            <td>{{ $estagio->data_inicio }}</td>
                            <td>{{ $estagio->data_fim }}</td>
                            <td>
                                <a href="{{ route('estagios.show', $estagio->id) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('estagios.edit', $estagio->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('estagios.destroy', $estagio->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este estágio?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Nenhum estágio encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $estagios->links() }}
    </div>
</div>
@endsection
