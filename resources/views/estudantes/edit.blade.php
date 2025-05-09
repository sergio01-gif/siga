@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-3xl px-4">
    <h1 class="text-2xl font-bold mb-6">Editar Estudante</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
            <strong>Erros encontrados:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('estudantes.update', $estudante->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="font-semibold">Nome</label>
            <input type="text" name="nome" class="w-full border rounded px-4 py-2" value="{{ old('nome', $estudante->nome) }}" required>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" class="w-full border rounded px-4 py-2" value="{{ old('email', $estudante->email) }}">
            </div>
            <div>
                <label class="font-semibold">Telefone</label>
                <input type="text" name="telefone" class="w-full border rounded px-4 py-2" value="{{ old('telefone', $estudante->telefone) }}" required>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="w-full border rounded px-4 py-2" value="{{ old('data_nascimento', $estudante->data_nascimento) }}">
            </div>
            <div>
                <label class="font-semibold">Gênero</label>
                <select name="genero" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    @foreach(['masculino', 'feminino', 'outro'] as $g)
                        <option value="{{ $g }}" {{ $estudante->genero === $g ? 'selected' : '' }}>{{ ucfirst($g) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="font-semibold">Morada</label>
            <textarea name="morada" class="w-full border rounded px-4 py-2">{{ old('morada', $estudante->morada) }}</textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Tipo de Documento</label>
                <select name="tipo_documento" id="tipo_documento" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    @foreach(['BI', 'Passaporte', 'DIRE', 'Outro'] as $tipo)
                        <option value="{{ $tipo }}" {{ $estudante->tipo_documento === $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>
            <div id="numero_documento_field" class="{{ $estudante->tipo_documento ? '' : 'hidden' }}">
                <label class="font-semibold">Número do Documento</label>
                <input type="text" name="numero_documento" class="w-full border rounded px-4 py-2" value="{{ old('numero_documento', $estudante->numero_documento) }}">
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="font-semibold">Curso</label>
                <select name="curso_id" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ $estudante->curso_id == $curso->id ? 'selected' : '' }}>{{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Turma</label>
                <select name="turma_id" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    @foreach($turmas as $turma)
                        <option value="{{ $turma->id }}" {{ $estudante->turma_id == $turma->id ? 'selected' : '' }}>{{ $turma->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Ano Letivo</label>
                <select name="ano_lectivo_id" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    @foreach($anos as $ano)
                        <option value="{{ $ano->id }}" {{ $estudante->ano_lectivo_id == $ano->id ? 'selected' : '' }}>{{ $ano->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Estado</label>
                <select name="estado" class="w-full border rounded px-4 py-2">
                    @foreach(['ativo', 'suspenso', 'transferido'] as $estado)
                        <option value="{{ $estado }}" {{ $estudante->estado === $estado ? 'selected' : '' }}>{{ ucfirst($estado) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Foto (opcional)</label>
                <input type="file" name="foto" class="w-full border rounded px-4 py-2">
                @if($estudante->foto)
                    <img src="{{ asset('storage/' . $estudante->foto) }}" alt="Foto" class="h-16 mt-2">
                @endif
            </div>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Atualizar Estudante
            </button>
        </div>
    </form>
</div>

<script>
    const tipoSelect = document.getElementById('tipo_documento');
    const numeroDocField = document.getElementById('numero_documento_field');

    tipoSelect.addEventListener('change', function () {
        if (this.value !== '') {
            numeroDocField.classList.remove('hidden');
        } else {
            numeroDocField.classList.add('hidden');
        }
    });
</script>
@endsection
