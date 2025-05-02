@extends('layouts.app')

@section('content')
    <h1>Lista de Cursos</h1>
    <a href="{{ route('cursos.create') }}" class="btn btn-primary">Adicionar Novo Curso</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Código</th>
                <th>Duração</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->nome }}</td>
                    <td>{{ $curso->codigo }}</td>
                    <td>{{ $curso->duracao }} anos</td>
                    <td>
                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
