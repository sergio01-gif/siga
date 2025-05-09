@csrf

<div class="mb-4">
    <label for="estudante_id" class="block text-gray-700">Estudante</label>
    <select name="estudante_id" id="estudante_id" class="border px-4 py-2 rounded w-full" required>
        @foreach($estudantes as $estudante)
            <option value="{{ $estudante->id }}" {{ (old('estudante_id', $mensalidade->estudante_id ?? '') == $estudante->id) ? 'selected' : '' }}>
                {{ $estudante->nome }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="mes_referencia" class="block text-gray-700">Mês de Referência</label>
    <select name="mes_referencia" id="mes_referencia" class="border px-4 py-2 rounded w-full" required>
        @foreach($meses as $mes)
            <option value="{{ $mes }}" {{ (old('mes_referencia', $mensalidade->mes_referencia ?? '') == $mes) ? 'selected' : '' }}>{{ $mes }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="valor" class="block text-gray-700">Valor (MZN)</label>
    <input type="number" step="0.01" name="valor" id="valor" value="{{ old('valor', $mensalidade->valor ?? '') }}" class="border px-4 py-2 rounded w-full" required>
</div>

<button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
    {{ $mensalidade ? 'Atualizar' : 'Salvar' }}
</button>
