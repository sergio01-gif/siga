@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Professor</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Por favor, verifique os campos obrigatórios.<br><br>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('professores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}" required>
        </div>

        <div class="mb-3">
            <label for="documento_identificacao" class="form-label">Documento de Identificação:</label>
            <input type="text" name="documento_identificacao" class="form-control" value="{{ old('documento_identificacao') }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo_contratacao" class="form-label">Tipo de Contratação</label>
            <select class="form-control" name="tipo_contratacao" required>
                <option value="">Selecione</option>
                <option value="Estagiário" {{ old('tipo_contratacao') == 'Estagiário' ? 'selected' : '' }}>Estagiário</option>
                <option value="Parcial" {{ old('tipo_contratacao') == 'Parcial' ? 'selected' : '' }}>Parcial</option>
                <option value="Tempo Inteiro" {{ old('tipo_contratacao') == 'Tempo Inteiro' ? 'selected' : '' }}>Tempo Inteiro</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade:</label>
            <input type="text" name="especialidade" class="form-control" value="{{ old('especialidade') }}" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuário Responsável:</label>
            <select name="usuario_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cadeiras" class="form-label">Cadeiras:</label>
            <select name="cadeiras[]" class="form-control" multiple>
                @foreach ($cadeiras as $cadeira)
                    <option value="{{ $cadeira->id }}" {{ (collect(old('cadeiras'))->contains($cadeira->id)) ? 'selected' : '' }}>
                        {{ $cadeira->nome }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Pressione Ctrl (ou Cmd no Mac) para selecionar várias cadeiras.</small>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
