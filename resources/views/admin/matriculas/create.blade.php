@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova Matrícula</h1>

    <form action="{{ route('admin.matriculas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">Aluno</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">-- Selecione --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Curso</label>
            <select name="course_id" id="course_id" class="form-control" required>
                <option value="">-- Selecione --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ano_lectivo" class="form-label">Ano Lectivo</label>
            <input type="text" name="ano_lectivo" class="form-control" required placeholder="Ex: 2024">
        </div>

        <div class="mb-3">
            <label for="data_matricula" class="form-label">Data da Matrícula</label>
            <input type="date" name="data_matricula" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado da Matrícula</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="">-- Selecione --</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('admin.matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
