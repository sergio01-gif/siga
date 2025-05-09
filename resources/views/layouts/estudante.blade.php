<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Painel do Estudante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <aside class="bg-white w-64 min-h-screen shadow-md hidden md:block">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-blue-700">SIGA Estudante</h2>
        </div>
        <nav class="p-4 space-y-2 text-gray-700">
            <a href="{{ route('estudantes.dashboard') }}" class="block hover:text-blue-600">🏠 Painel</a>
            <a href="{{ route('estudantes.perfil') }}" class="block hover:text-blue-600">👤 Perfil</a>
            <a href="{{ route('estudantes.notas') }}" class="block hover:text-blue-600">📚 Notas</a>
            <a href="{{ route('estudantes.pagamentos') }}" class="block hover:text-blue-600">💳 Pagamentos</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-4 text-red-600 hover:underline">🚪 Sair</button>
            </form>
        </nav>
    </aside>

    {{-- Conteúdo principal --}}
    <main class="flex-1 overflow-y-auto">
        <div class="p-4">
            @yield('content')
        </div>
    </main>

</body>
</html>
