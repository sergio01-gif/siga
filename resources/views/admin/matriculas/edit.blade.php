@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Matrícula</h1>

    <form action="{{ route('admin.matriculas.update', $matricula->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_id" class="form-label">Aluno</label>
            <select name="student_id" id="student_id" class="form-control" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $matricula->student_id ? 'selected' : '' }}>
                        {{ $student->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Curso</label>
            <select name="course_id" id="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $course->id == $matricula->course_id ? 'selected' : '' }}>
                        {{ $course->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ano_lectivo" class="form-label">Ano Lectivo</label>
            <input type="text" name="ano_lectivo" class="form-control" value="{{ $matricula->ano_lectivo }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('admin.matriculas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
