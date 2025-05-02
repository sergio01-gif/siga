@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Matrículas</h1>

    <a href="{{ route('admin.matriculas.create') }}" class="btn btn-primary mb-3">Nova Matrícula</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Ano Lectivo</th>
                <th>Data da Matrícula</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->student->nome }}</td>
                    <td>{{ $matricula->course->nome }}</td>
                    <td>{{ $matricula->ano_lectivo }}</td>
                    <td>{{ $matricula->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.matriculas.edit', $matricula->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.matriculas.destroy', $matricula->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($matriculas->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Nenhuma matrícula encontrada.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
