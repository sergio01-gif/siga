@extends('layouts.app')

@section('content')
    <h1>Cadastrar Ano Acadêmico</h1>

    <form action="{{ route('ano_academicos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ano_inicio">Ano de Início</label>
            <input type="number" name="ano_inicio" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ano_fim">Ano de Fim</label>
            <input type="number" name="ano_fim" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Salvar</button>
    </form>
@endsection
