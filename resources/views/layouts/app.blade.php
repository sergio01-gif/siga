<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'IMPOM')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">

        {{-- LEFT MENU (Sidebar) --}}
        <aside class="w-64 bg-white shadow-lg hidden md:block">
            @include('layouts.partials.leftmenu')
        </aside>

        {{-- CONTEÚDO PRINCIPAL --}}
        <div class="flex-1 p-4">

            {{-- NAVBAR SUPERIOR --}}
            <nav class="bg-white shadow px-6 py-3 flex justify-between items-center mb-4">
    <div class="flex items-center space-x-2">
        <img src="{{ asset('images/logo.png') }}" alt="Logo IMPOM" style="width: 30px; height: 30px; object-fit: contain;" />
        <span class="text-base font-semibold text-[#0072CE]"></span>
    </div>

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-blue-600">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm text-red-600 hover:underline">Sair</button>
        </form>
    </div>
</nav>


            {{-- CONTEÚDO DA PÁGINA --}}
            @yield('content')
        </div>
        
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
@include('layouts.partials.footer')

</html>
