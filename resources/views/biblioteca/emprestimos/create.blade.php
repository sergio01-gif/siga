@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Registrar Empréstimo</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('emprestimos.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="livro_id" class="block text-gray-700">Livro</label>
            <select name="livro_id" id="livro_id" class="border px-4 py-2 rounded w-full" required>
                <option value="">Selecione</option>
                @foreach($livros as $livro)
                    <option value="{{ $livro->id }}" {{ old('livro_id') == $livro->id ? 'selected' : '' }}>
                        {{ $livro->titulo }} ({{ $livro->quantidade_disponivel }} disp.)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="estudante_id" class="block text-gray-700">Estudante</label>
            <select name="estudante_id" id="estudante_id" class="border px-4 py-2 rounded w-full" required>
                <option value="">Selecione</option>
                @foreach($estudantes as $estudante)
                    <option value="{{ $estudante->id }}" {{ old('estudante_id') == $estudante->id ? 'selected' : '' }}>
                        {{ $estudante->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="data_emprestimo" class="block text-gray-700">Data do Empréstimo</label>
            <input type="date" name="data_emprestimo" id="data_emprestimo" value="{{ old('data_emprestimo', date('Y-m-d')) }}" class="border px-4 py-2 rounded w-full" required>
        </div>

        <div class="mb-4">
            <label for="data_devolucao_prevista" class="block text-gray-700">Devolver até</label>
            <input type="date" name="data_devolucao_prevista" id="data_devolucao_prevista" value="{{ old('data_devolucao_prevista') }}" class="border px-4 py-2 rounded w-full" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Registrar</button>
    </form>
</div>
@endsection
