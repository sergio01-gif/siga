@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Atribuir Disciplinas ao Professor: {{ $professor->nome }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('professores.atribuirDisciplinas', $professor->id) }}" method="POST">
        @csrf

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Selecionar</th>
                        <th>Disciplina (Cadeira)</th>
                        <th>Turma</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadeiras as $cadeira)
                        <tr>
                            <td>
                                <input type="checkbox" name="cadeiras[{{ $cadeira->id }}]" value="{{ old('cadeiras.' . $cadeira->id, $professor->cadeiras->contains($cadeira->id) ? $professor->cadeiras->find($cadeira->id)->pivot->turma_id : '') }}">
                            </td>
                            <td>{{ $cadeira->nome }}</td>
                            <td>
                                <select name="cadeiras[{{ $cadeira->id }}]" class="form-control">
                                    <option value="">-- Escolher Turma --</option>
                                    @foreach($turmas as $turma)
                                        <option value="{{ $turma->id }}"
                                            @if($professor->cadeiras->contains($cadeira->id) && $professor->cadeiras->find($cadeira->id)->pivot->turma_id == $turma->id)
                                                selected
                                            @endif
                                        >
                                            {{ $turma->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Atribuições</button>
        <a href="{{ route('professores.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
