@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-3xl px-4">
    <h1 class="text-2xl font-bold mb-6">Cadastrar Novo Estudante</h1>

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

    <form action="{{ route('estudantes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="font-semibold">Nome</label>
            <input type="text" name="nome" class="w-full border rounded px-4 py-2" value="{{ old('nome') }}" required>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" class="w-full border rounded px-4 py-2" value="{{ old('email') }}">
            </div>
            <div>
                <label class="font-semibold">Telefone</label>
                <input type="text" name="telefone" class="w-full border rounded px-4 py-2" value="{{ old('telefone') }}" required>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="w-full border rounded px-4 py-2" value="{{ old('data_nascimento') }}">
            </div>
            <div>
                <label class="font-semibold">Gênero</label>
                <select name="genero" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
        </div>

        <div>
            <label class="font-semibold">Morada</label>
            <textarea name="morada" class="w-full border rounded px-4 py-2">{{ old('morada') }}</textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Tipo de Documento</label>
                <select name="tipo_documento" id="tipo_documento" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    <option value="BI">BI</option>
                    <option value="Passaporte">Passaporte</option>
                    <option value="DIRE">DIRE</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div id="numero_documento_field" class="{{ old('tipo_documento') ? '' : 'hidden' }}">
                <label class="font-semibold">Número do Documento</label>
                <input type="text" name="numero_documento" class="w-full border rounded px-4 py-2" value="{{ old('numero_documento') }}">
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="font-semibold">Curso</label>
                <select name="curso_id" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Turma</label>
                <select name="turma_id" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    @foreach($turmas as $turma)
                        <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Ano Letivo</label>
                <select name="ano_lectivo_id" class="w-full border rounded px-4 py-2">
                    <option value="">Selecione</option>
                    @foreach($anos as $ano)
                        <option value="{{ $ano->id }}">{{ $ano->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Estado</label>
                <select name="estado" class="w-full border rounded px-4 py-2">
                    <option value="ativo">Ativo</option>
                    <option value="suspenso">Suspenso</option>
                    <option value="transferido">Transferido</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Foto</label>
                <input type="file" name="foto" class="w-full border rounded px-4 py-2">
            </div>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Salvar Estudante
            </button>
        </div>
    </form>
</div>

<script>
    // Mostrar ou esconder campo número do documento
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
