@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 max-w-4xl">
    <h1 class="text-2xl font-bold mb-4">Configurações do Sistema</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-400 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('configuracoes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Nome da Instituição</label>
            <input type="text" name="nome_instituicao" value="{{ old('nome_instituicao', $config->nome_instituicao ?? '') }}" class="border rounded w-full px-4 py-2" required>
        </div>

        <div>
            <label class="block font-semibold">Sigla</label>
            <input type="text" name="sigla" value="{{ old('sigla', $config->sigla ?? '') }}" class="border rounded w-full px-4 py-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $config->email ?? '') }}" class="border rounded w-full px-4 py-2">
            </div>
            <div>
                <label class="block font-semibold">Telefone</label>
                <input type="text" name="telefone" value="{{ old('telefone', $config->telefone ?? '') }}" class="border rounded w-full px-4 py-2">
            </div>
        </div>

        <div>
            <label class="block font-semibold">Endereço</label>
            <textarea name="endereco" rows="2" class="border rounded w-full px-4 py-2">{{ old('endereco', $config->endereco ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Moeda</label>
                <input type="text" name="moeda" value="{{ old('moeda', $config->moeda ?? 'MZN') }}" class="border rounded w-full px-4 py-2">
            </div>
            <div>
                <label class="block font-semibold">Idioma</label>
                <select name="idioma" class="border rounded w-full px-4 py-2">
                    <option value="pt" {{ ($config->idioma ?? '') == 'pt' ? 'selected' : '' }}>Português</option>
                    <option value="en" {{ ($config->idioma ?? '') == 'en' ? 'selected' : '' }}>Inglês</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block font-semibold">Ano Letivo Ativo</label>
            <select name="ano_lectivo_ativo" class="border rounded w-full px-4 py-2">
                @foreach($anos as $ano)
                    <option value="{{ $ano->id }}" {{ ($config->ano_lectivo_ativo ?? '') == $ano->id ? 'selected' : '' }}>
                        {{ $ano->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold">Logotipo</label>
            <input type="file" name="logo" class="border rounded w-full px-4 py-2">
            @if(isset($config->logo))
                <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo" class="h-16 mt-2">
            @endif
        </div>

        <div>
            <label class="block font-semibold">Tema</label>
            <select name="tema" class="border rounded w-full px-4 py-2">
                <option value="claro" {{ ($config->tema ?? '') == 'claro' ? 'selected' : '' }}>Claro</option>
                <option value="escuro" {{ ($config->tema ?? '') == 'escuro' ? 'selected' : '' }}>Escuro</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
            Guardar Configurações
        </button>
    </form>
</div>
@endsection
