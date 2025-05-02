@extends('layouts.app')

@section('content')
    <h1>Editar Ano Acadêmico</h1>

    <form action="{{ route('ano_academicos.update', $anoAcademico->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ano">Ano</label>
            <input type="number" name="ano" class="form-control" value="{{ $anoAcademico->ano }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="ativo" {{ $anoAcademico->status == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ $anoAcademico->status == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning mt-3">Atualizar</button>
    </form>
@endsection
