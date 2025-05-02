@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Adicionar Novo Estudante</h2>

    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Gênero</label>
                <select name="genero" class="form-select" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Morada</label>
                <input type="text" name="morada" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Nº Estudante</label>
                <input type="text" name="numero_estudante" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Curso</label>
                <select name="course_id" class="form-select" required>
                    <option value="">Selecione o curso</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Ano Letivo</label>
                <input type="text" name="ano_lectivo" class="form-control" placeholder="Ex: 2024" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select" required>
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                    <option value="Transferido">Transferido</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
