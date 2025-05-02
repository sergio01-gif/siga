@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Lista de Professores</h2>

    <!-- Botão para adicionar um novo professor -->
    <a href="{{ route('professores.create') }}" class="btn btn-success mb-3">Adicionar Professor</a>

    <!-- Tabela com os dados dos professores -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Especialidade</th>
                <th>Cadeiras</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($professores as $professor)
                <tr>
                    <td>{{ $professor->nome }}</td>
                    <td>{{ $professor->email }}</td>
                    <td>{{ $professor->telefone }}</td>
                    <td>{{ $professor->especialidade }}</td>
                    <td>
                        <!-- Exibindo as cadeiras do professor -->
                        @foreach($professor->cadeiras as $cadeira)
                            <span class="badge badge-primary">{{ $cadeira->nome }}</span>
                        @endforeach
                    </td>
                    <td>
                        <!-- Botão para editar o professor -->
                        <a href="{{ route('professores.edit', $professor->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Botão para deletar o professor -->
                        <form action="{{ route('professores.destroy', $professor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>

                        <!-- Botão para imprimir os detalhes do professor -->
                        <a href="{{ route('professores.imprimir', $professor->id) }}" class="btn btn-info btn-sm" target="_blank">Imprimir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginação -->
    {{ $professores->links() }}
</div>
@endsection
