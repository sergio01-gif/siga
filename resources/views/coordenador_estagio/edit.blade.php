@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-white mb-4">Editar Estágio</h1>

    <form action="{{ route('estagios.update', $estagio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label text-white">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ $estagio->titulo }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Descrição</label>
            <textarea name="descricao" class="form-control">{{ $estagio->descricao }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Estudante</label>
            <select name="estudante_id" class="form-control" required>
                @foreach($estudantes as $estudante)
                    <option value="{{ $estudante->id }}" @if($estudante->id == $estagio->estudante_id) selected @endif>
                        {{ $estudante->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Data de Início</label>
            <input type="date" name="data_inicio" class="form-control" value="{{ $estagio->data_inicio }}">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Data de Fim</label>
            <input type="date" name="data_fim" class="form-control" value="{{ $estagio->data_fim }}">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Status</label>
            <select name="status" class="form-control">
                <option value="pendente" @if($estagio->status == 'pendente') selected @endif>Pendente</option>
                <option value="ativo" @if($estagio->status == 'ativo') selected @endif>Ativo</option>
                <option value="concluido" @if($estagio->status == 'concluido') selected @endif>Concluído</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('estagios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
