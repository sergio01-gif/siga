<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <!-- Vite Assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  


</head>
<body class="bg-gray-100">
    <div id="app">
        <div class="flex min-h-screen">
            <!-- Menu lateral -->
            @include('layouts.left-menu')

            <!-- Conteúdo Principal -->
            <div class="flex-1 flex flex-col">
                <!-- Navbar -->
                <nav class="bg-white border-b shadow">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                        <div class="flex items-center">
                            <!-- Logotipo da Empresa -->
                            <a href="{{ url('/') }}" class="flex items-center">
                                <!-- Substituir pelo caminho da imagem do logo -->
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 mr-2">
                                <span class="text-xl font-bold text-gray-800">
                                    {{ config('app.name', 'Laravel') }}
                                </span>
                            </a>
                        </div>

                        <div class="flex items-center">
                            @guest
                                <div class="flex space-x-4">
                                    @if (Route::has('login'))
                                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">{{ __('Login') }}</a>
                                    @endif
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">{{ __('Register') }}</a>
                                    @endif
                                </div>
                            @else
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center text-gray-600 hover:text-gray-800 focus:outline-none">
                                        <i class="fas fa-user-circle text-2xl mr-2"></i>
                                        {{ Auth::user()->name }}
                                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown -->
                                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-user-edit mr-2"></i>{{ __('Perfil') }}
                                        </a>
                                        <a href="{{ route('password.request') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-key mr-2"></i>{{ __('Redefinir Senha') }}
                                        </a>
                                        <a href="{{ route('logout') }}" 
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endguest
                        </div>
                    </div>
                </nav>

                <!-- Conteúdo da Página -->
                <main class="flex-1 p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Alpine.js para o Dropdown -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
