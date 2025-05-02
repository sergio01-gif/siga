@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Listagem de Estudantes</h1>

        <!-- Botão de Adicionar Estudante -->
        <div class="mb-6">
            <a href="{{ route('estudantes.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Adicionar Estudante</a>
        </div>

        <!-- Filtros -->
        <div class="mb-6 p-4 border rounded shadow-md bg-white">
            <form action="{{ route('estudantes.index') }}" method="GET" class="flex space-x-4">
                <div class="flex items-center space-x-2">
                    <label for="curso_id" class="font-medium">Curso:</label>
                    <select name="curso_id" id="curso_id" class="border px-4 py-2 rounded-md">
                        <option value="">Selecione o Curso</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center space-x-2">
                    <label for="turma_id" class="font-medium">Turma:</label>
                    <select name="turma_id" id="turma_id" class="border px-4 py-2 rounded-md">
                        <option value="">Selecione a Turma</option>
                        @foreach($turmas as $turma)
                            <option value="{{ $turma->id }}" {{ request('turma_id') == $turma->id ? 'selected' : '' }}>{{ $turma->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Filtrar</button>
            </form>
        </div>

        <!-- Tabela de Estudantes -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto bg-white border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left border-b">Nome</th>
                        <th class="py-2 px-4 text-left border-b">Email</th>
                        <th class="py-2 px-4 text-left border-b">Telefone</th>
                        <th class="py-2 px-4 text-left border-b">Data de Nascimento</th>
                        <th class="py-2 px-4 text-left border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($estudantes as $estudante)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $estudante->nome }}</td>
                            <td class="py-2 px-4 border-b">{{ $estudante->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $estudante->telefone }}</td>
                            <td class="py-2 px-4 border-b">{{ $estudante->data_nascimento }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('estudantes.show', $estudante) }}" class="text-blue-500 hover:text-blue-700">Ver</a>
                                <a href="{{ route('estudantes.edit', $estudante) }}" class="ml-2 text-yellow-500 hover:text-yellow-700">Editar</a>

                                <!-- Emissão de Fatura -->
                                <form action="{{ route('estudantes.emitirFactura', $estudante->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="ml-2 text-green-500 hover:text-green-700">Emitir Fatura</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botões para exportação -->
        <div class="mt-6 flex space-x-4">
            <form action="{{ route('estudantes.exportExcel') }}" method="GET" class="inline-block">
                <input type="hidden" name="curso_id" value="{{ request('curso_id') }}">
                <input type="hidden" name="turma_id" value="{{ request('turma_id') }}">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">Exportar para Excel</button>
            </form>

            <form action="{{ route('estudantes.exportPDF') }}" method="GET" class="inline-block">
                <input type="hidden" name="curso_id" value="{{ request('curso_id') }}">
                <input type="hidden" name="turma_id" value="{{ request('turma_id') }}">
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700">Exportar para PDF</button>
            </form>
        </div>
    </div>
@endsection
