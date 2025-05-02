@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Alunos</h2>
    <form method="GET" action="{{ route('admin.students.index') }}" class="d-flex mb-3">
    <input type="text" class="form-control" name="search" placeholder="Pesquisar aluno" value="{{ request('search') }}">
    <button type="submit" class="btn btn-primary ml-2">Buscar</button>
</form>

    {{-- Filtro --}}
    <form method="GET" action="{{ route('admin.students.index') }}" class="mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="curso_id" class="form-label">Curso</label>
                <select name="curso_id" id="curso_id" class="form-select">
                    <option value="">Todos os Cursos</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ request()->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="ano_lectivo" class="form-label">Ano Letivo</label>
                <input type="text" name="ano_lectivo" id="ano_lectivo" class="form-control"
                       placeholder="Ex: 2024" value="{{ request()->ano_lectivo }}">
            </div>

            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel-fill"></i> Filtrar
                </button>
            </div>
        </div>
    </form>

    {{-- Ações rápidas --}}
    <div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="d-flex gap-2">
            <a href="{{ route('admin.students.exportExcel', request()->only(['curso_id', 'ano_lectivo'])) }}"
               class="btn btn-success">
                <i class="bi bi-file-earmark-excel-fill"></i> Exportar Excel
            </a>

            <a href="{{ route('admin.students.exportPDF', request()->only(['curso_id', 'ano_lectivo'])) }}"
               class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf-fill"></i> Exportar PDF
            </a>
        </div>

        {{-- Botão Adicionar Aluno --}}
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle-fill"></i> Adicionar Aluno
        </a>
    </div>

    {{-- Tabela de alunos --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Curso</th>
                    <th>Ano Letivo</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->nome }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->telefone }}</td>
                        <td>{{ $student->course->nome }}</td>
                        <td>{{ $student->ano_lectivo }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>

                            <form action="{{ route('admin.students.destroy', $student->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este aluno?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash3"></i> Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Nenhum aluno encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
