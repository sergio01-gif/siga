@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Cadeiras</h1>

    <a href="{{ route('cadeiras.create') }}" class="btn btn-primary mb-3">Adicionar Nova Cadeira</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>Cursos</th>
                    <th>Carga Horária</th>
                    <th>Semestre</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cadeiras as $cadeira)
                    <tr>
                        <td>{{ $cadeira->nome }}</td>
                        <td>
                            @foreach($cadeira->cursos as $curso)
                                {{ $curso->nome }}<br>
                            @endforeach
                        </td>
                        <td>{{ $cadeira->carga_horaria }} horas</td>
                        <td>{{ $cadeira->semestre }}º</td>
                        <td>{{ $cadeira->estado }}</td>
                        <td>
                            <a href="{{ route('cadeiras.edit', $cadeira->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('cadeiras.destroy', $cadeira->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja eliminar esta cadeira?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
