@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Cadastrar Novo Estudante</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('estudantes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}" required>
            </div>

            <div class="col-md-6">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="form-control" value="{{ old('data_nascimento') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="genero" class="form-label">Gênero</label>
                <select name="genero" class="form-select" required>
                    <option value="">Selecione</option>
                    <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="feminino" {{ old('genero') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="morada" class="form-label">Morada</label>
                <input type="text" name="morada" class="form-control" value="{{ old('morada') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="documento_identificacao" class="form-label">Documento de Identificação</label>
                <input type="text" name="documento_identificacao" class="form-control" value="{{ old('documento_identificacao') }}" required>
            </div>

            <div class="col-md-3">
                <label for="curso_id" class="form-label">Curso</label>
                <select name="curso_id" class="form-select" required>
                    <option value="">Selecione</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                            {{ $curso->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="turma_id" class="form-label">Turma</label>
                <select name="turma_id" class="form-select" required>
                    <option value="">Selecione</option>
                    @foreach($turmas as $turma)
                        <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                            {{ $turma->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto de Perfil (opcional)</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="{{ route('estudantes.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
