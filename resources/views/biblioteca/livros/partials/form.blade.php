@csrf

<div class="mb-4">
    <label for="titulo" class="block text-gray-700">Título</label>
    <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $livro->titulo ?? '') }}" class="border px-4 py-2 rounded w-full" required>
</div>

<div class="mb-4">
    <label for="autor" class="block text-gray-700">Autor</label>
    <input type="text" name="autor" id="autor" value="{{ old('autor', $livro->autor ?? '') }}" class="border px-4 py-2 rounded w-full">
</div>

<div class="mb-4">
    <label for="categoria" class="block text-gray-700">Categoria</label>
    <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $livro->categoria ?? '') }}" class="border px-4 py-2 rounded w-full">
</div>

<div class="mb-4">
    <label for="codigo_exemplar" class="block text-gray-700">Código do Exemplar</label>
    <input type="text" name="codigo_exemplar" id="codigo_exemplar" value="{{ old('codigo_exemplar', $livro->codigo_exemplar ?? '') }}" class="border px-4 py-2 rounded w-full" required>
</div>

<div class="mb-4">
    <label for="quantidade_total" class="block text-gray-700">Quantidade Total</label>
    <input type="number" name="quantidade_total" id="quantidade_total" value="{{ old('quantidade_total', $livro->quantidade_total ?? 1) }}" class="border px-4 py-2 rounded w-full" required>
</div>

<div class="mb-4">
    <label for="ano_publicacao" class="block text-gray-700">Ano de Publicação</label>
    <input type="text" name="ano_publicacao" id="ano_publicacao" value="{{ old('ano_publicacao', $livro->ano_publicacao ?? '') }}" class="border px-4 py-2 rounded w-full">
</div>

<div class="mb-4">
    <label for="editora" class="block text-gray-700">Editora</label>
    <input type="text" name="editora" id="editora" value="{{ old('editora', $livro->editora ?? '') }}" class="border px-4 py-2 rounded w-full">
</div>

<div class="mb-4">
    <label for="estado" class="block text-gray-700">Estado</label>
    <select name="estado" id="estado" class="border px-4 py-2 rounded w-full">
        <option value="ativo" {{ (old('estado', $livro->estado ?? '') == 'ativo') ? 'selected' : '' }}>Ativo</option>
        <option value="inativo" {{ (old('estado', $livro->estado ?? '') == 'inativo') ? 'selected' : '' }}>Inativo</option>
    </select>
</div>

<button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
    {{ isset($livro) ? 'Atualizar' : 'Salvar' }}
</button>
