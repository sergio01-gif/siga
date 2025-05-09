@extends('layouts.estudante')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-bold mb-4">Histórico de Pagamentos</h2>

    @if($pagamentos->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Referência</th>
                        <th class="px-4 py-2 text-left">Valor</th>
                        <th class="px-4 py-2 text-left">Data</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                        <th class="px-4 py-2 text-left">Comprovativo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagamentos as $pagamento)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $pagamento->referencia }}</td>
                            <td class="px-4 py-2">{{ number_format($pagamento->valor, 2, ',', '.') }} MZN</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($pagamento->created_at)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ ucfirst($pagamento->estado) }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('faturas.visualizar', $pagamento->id) }}" target="_blank" class="text-blue-600 hover:underline">
                                    Ver PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Nenhum pagamento registado.</p>
    @endif
</div>
@endsection
