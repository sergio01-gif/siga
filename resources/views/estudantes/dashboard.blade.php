@extends('layouts.estudante')

@section('content')
<div class="container mx-auto px-4 py-6 space-y-6">

    {{-- Cabeçalho --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-4 md:mb-0">Olá, {{ $estudante->nome }}</h1>
        <div class="flex space-x-4">
            <a href="{{ route('estudantes.perfil') }}" class="flex items-center bg-white shadow rounded-full px-3 py-1 hover:shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z" />
                </svg>
                Ver Perfil
            </a>
        </div>
    </div>

    {{-- Cards de Resumo --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-500">Mensalidades Pagas</p>
            <p class="mt-2 text-2xl font-bold text-gray-800">{{ $mensalidadesPagas }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-yellow-500">
            <p class="text-sm font-medium text-gray-500">Mensalidades Pendentes</p>
            <p class="mt-2 text-2xl font-bold text-gray-800">{{ $mensalidadesPendentes }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-indigo-500">
            <p class="text-sm font-medium text-gray-500">Cursos Matriculados</p>
            <p class="mt-2 text-2xl font-bold text-gray-800">{{ $matricula ? $matricula->curso->nome : '—' }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-pink-500">
            <p class="text-sm font-medium text-gray-500">Último Estágio</p>
            <p class="mt-2 text-2xl font-bold text-gray-800">{{ $estagio ? ucfirst($estagio->estado) : '—' }}</p>
        </div>
    </div>

    {{-- Seção: Dados Pessoais --}}
    <section class="bg-white rounded-lg shadow divide-y divide-gray-100">
        <h2 class="px-5 py-3 text-xl font-semibold text-gray-700">Dados Pessoais</h2>
        <div class="px-5 py-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <p><span class="font-medium">Nome:</span> {{ $estudante->nome }}</p>
            <p><span class="font-medium">Email:</span> {{ $estudante->email ?? '—' }}</p>
            <p><span class="font-medium">Telefone:</span> {{ $estudante->telefone }}</p>
            <p><span class="font-medium">Estado:</span> {{ ucfirst($estudante->estado) }}</p>
        </div>
    </section>

    {{-- Seção: Notas --}}
    <section class="bg-white rounded-lg shadow divide-y divide-gray-100">
        <h2 class="px-5 py-3 text-xl font-semibold text-gray-700">Últimas Notas</h2>
        <div class="px-5 py-4">
            @if($notas->isNotEmpty())
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($notas as $nota)
                        <li class="bg-gray-50 p-4 rounded hover:bg-gray-100 transition">
                            <p class="text-sm text-gray-500">{{ $nota->disciplina->nome }}</p>
                            <p class="mt-1 text-lg font-bold text-gray-800">{{ $nota->valor }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Nenhuma nota lançada.</p>
            @endif
        </div>
    </section>

    {{-- Seção: Empréstimos --}}
    <section class="bg-white rounded-lg shadow divide-y divide-gray-100">
        <h2 class="px-5 py-3 text-xl font-semibold text-gray-700">Empréstimos de Livros</h2>
        <div class="px-5 py-4">
            @if($emprestimos->isNotEmpty())
                <ul class="space-y-2">
                    @foreach($emprestimos as $e)
                        <li class="flex justify-between items-center bg-gray-50 p-3 rounded hover:bg-gray-100 transition">
                            <span>{{ $e->livro->titulo }}</span>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($e->data_emprestimo)->format('d/m/Y') }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Nenhum livro emprestado.</p>
            @endif
        </div>
    </section>

    {{-- Seção: Pagamentos --}}
    <section class="bg-white rounded-lg shadow divide-y divide-gray-100">
        <h2 class="px-5 py-3 text-xl font-semibold text-gray-700">Histórico de Pagamentos</h2>
        <div class="px-5 py-4 overflow-x-auto">
            @if($pagamentos->isNotEmpty())
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">Referência</th>
                            <th class="px-4 py-2 text-left">Valor</th>
                            <th class="px-4 py-2 text-left">Data</th>
                            <th class="px-4 py-2 text-left">Estado</th>
                            <th class="px-4 py-2 text-left">Comprovativo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagamentos as $pag)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-4 py-2">{{ $pag->referencia }}</td>
                                <td class="px-4 py-2">{{ number_format($pag->valor, 2, ',', '.') }} MZN</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($pag->created_at)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ ucfirst($pag->estado) }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('faturas.visualizar', $pag->id) }}" target="_blank"
                                       class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">
                                        Ver PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Nenhum pagamento registado.</p>
            @endif
        </div>
    </section>

</div>
@endsection
