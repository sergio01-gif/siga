@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">Detalhes do Estudante</h1>

        <!-- Detalhes do Estudante -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="mb-4">
                <strong class="text-lg">Nome:</strong>
                <p>{{ $estudante->nome }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-lg">Email:</strong>
                <p>{{ $estudante->email }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-lg">Telefone:</strong>
                <p>{{ $estudante->telefone }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-lg">Data de Nascimento:</strong>
                <p>{{ \Carbon\Carbon::parse($estudante->data_nascimento)->format('d/m/Y') }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-lg">Curso:</strong>
                <p>{{ $estudante->curso->nome }}</p>
            </div>

            <div class="mb-4">
                <strong class="text-lg">Turma:</strong>
                <p>{{ $estudante->turma->nome }}</p>
            </div>

            <!-- Se houver foto do estudante -->
            @if($estudante->foto)
                <div class="mb-4">
                    <strong class="text-lg">Foto:</strong>
                    <img src="{{ asset('storage/'.$estudante->foto) }}" alt="Foto do Estudante" class="w-32 h-32 rounded-full mt-2">
                </div>
            @endif
        </div>

        <!-- Mensalidades do Estudante -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Mensalidades</h2>

            @if($estudante->mensalidades->isEmpty())
                <p class="text-red-500">Nenhuma mensalidade encontrada para este estudante.</p>
            @else
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b">Mês</th>
                            <th class="px-4 py-2 border-b">Valor</th>
                            <th class="px-4 py-2 border-b">Status</th>
                            <th class="px-4 py-2 border-b">Data de Vencimento</th>
                            <th class="px-4 py-2 border-b">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estudante->mensalidades as $mensalidade)
                            <tr>
                                <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($mensalidade->mes)->format('F Y') }}</td>
                                <td class="px-4 py-2 border-b">{{ number_format($mensalidade->valor, 2, ',', '.') }} MZN</td>
                                <td class="px-4 py-2 border-b">
                                    @if($mensalidade->status == 'pendente')
                                        <span class="text-yellow-500">Pendente</span>
                                    @elseif($mensalidade->status == 'pago')
                                        <span class="text-green-500">Pago</span>
                                    @else
                                        <span class="text-red-500">Em atraso</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($mensalidade->data_vencimento)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 border-b">
                                    @if($mensalidade->status == 'pendente')
                                        <a href="{{ route('estudantes.emitirFactura', $estudante->id) }}" class="text-blue-500 hover:text-blue-700">Emitir Fatura</a>
                                    @else
                                        <span class="text-gray-500">Fatura Emitida</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('estudantes.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Voltar para a Lista</a>
        </div>
    </div>
@endsection
