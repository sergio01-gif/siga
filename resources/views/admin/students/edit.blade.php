@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Editar Aluno</h2>

    <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                <input type="text" name="nome" id="nome" value="{{ $student->nome }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $student->email }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
            </div>

            <div>
                <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="{{ $student->telefone }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" value="{{ $student->data_nascimento }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700">Gênero</label>
                <select name="genero" id="genero" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="Masculino" @if($student->genero == 'Masculino') selected @endif>Masculino</option>
                    <option value="Feminino" @if($student->genero == 'Feminino') selected @endif>Feminino</option>
                </select>
            </div>

            <div>
                <label for="morada" class="block text-sm font-medium text-gray-700">Morada</label>
                <input type="text" name="morada" id="morada" value="{{ $student->morada }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="numero_estudante" class="block text-sm font-medium text-gray-700">Número de Estudante</label>
                <input type="text" name="numero_estudante" id="numero_estudante" value="{{ $student->numero_estudante }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="curso_id" class="block text-sm font-medium text-gray-700">Curso</label>
                <select name="curso_id" id="curso_id" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" @if($student->course_id == $course->id) selected @endif>{{ $course->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="ano_lectivo" class="block text-sm font-medium text-gray-700">Ano Letivo</label>
                <input type="text" name="ano_lectivo" id="ano_lectivo" value="{{ $student->ano_lectivo }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="estado" id="estado" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="Ativo" @if($student->estado == 'Ativo') selected @endif>Ativo</option>
                    <option value="Inativo" @if($student->estado == 'Inativo') selected @endif>Inativo</option>
                    <option value="Transferido" @if($student->estado == 'Transferido') selected @endif>Transferido</option>
                </select>
            </div>

            <div class="col-span-2">
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto (opcional)</label>
                <input type="file" name="foto" id="foto" class="mt-1 block w-full text-gray-700">
            </div>
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Atualizar Aluno
            </button>
        </div>
    </form>
</div>
@endsection
