@csrf

<div class="mb-4">
    <label for="estudante_id" class="block text-gray-700">Estudante</label>
    <select name="estudante_id" id="estudante_id" class="border px-4 py-2 rounded w-full" required>
        @foreach($estudantes as $estudante)
            <option value="{{ $estudante->id }}" {{ old('estudante_id', $estagio->estudante_id ?? '') == $estudante->id ? 'selected' : '' }}>
                {{ $estudante->nome }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="empresa" class="block text-gray-700">Empresa</label>
    <input type="text" name="empresa" id="empresa" value="{{ old('empresa', $estagio->empresa ?? '') }}" class="border px-4 py-2 rounded w-full" required>
</div>

<div class="mb-4">
    <label for="area" class="block text-gray-700">Área de Atuação</label>
    <input type="text" name="area" id="area" value="{{ old('area', $estagio->area ?? '') }}" class="border px-4 py-2 rounded w-full" required>
</div>

<div class="mb-4">
    <label for="data_inicio" class="block text-gray-700">Data de Início</label>
    <input type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio', $estagio->data_inicio ?? '') }}" class="border px-4 py-2 rounded w-full" required>
</div>

<div class="mb-4">
    <label for="data_fim" class="block text-gray-700">Data de Fim</label>
    <input type="date" name="data_fim" id="data_fim" value="{{ old('data_fim', $estagio->data_fim ?? '') }}" class="border px-4 py-2 rounded w-full">
</div>

<div class="mb-4">
    <label for="orientador" class="block text-gray-700">Orientador</label>
    <input type="text" name="orientador" id="orientador" value="{{ old('orientador', $estagio->orientador ?? '') }}" class="border px-4 py-2 rounded w-full">
</div>

@if(isset($estagio))
<div class="mb-4">
    <label for="status" class="block text-gray-700">Status</label>
    <select name="status" id="status" class="border px-4 py-2 rounded w-full">
        <option value="em_andamento" {{ $estagio->status == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
        <option value="concluido" {{ $estagio->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
        <option value="cancelado" {{ $estagio->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>
</div>
@endif

<button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
    {{ isset($estagio) ? 'Atualizar' : 'Salvar' }}
</button>
