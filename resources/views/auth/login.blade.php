@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10 px-4">
    <div class="w-full max-w-sm bg-white p-6 rounded-xl shadow-md space-y-6">

        <!-- Logotipo Compacto -->
        <div class="flex flex-col items-center">
            <img class="w-14 h-14 mb-2" src="{{ asset('images/logo.png') }}" alt="Logo IMPOM">
            <h2 class="text-lg font-bold text-[#0072CE] text-center">Instituto IMPOM</h2>
            <p class="text-sm text-gray-600 text-center">Acesso ao sistema académico</p>
        </div>

        <!-- Formulário -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0072CE] focus:border-[#0072CE] sm:text-sm @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Senha -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input id="password" name="password" type="password" required
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0072CE] focus:border-[#0072CE] sm:text-sm @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lembrar -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="mr-2 border-gray-300 text-[#0072CE]" {{ old('remember') ? 'checked' : '' }}>
                    Lembrar-me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-[#0072CE] hover:underline">Esqueceu a senha?</a>
                @endif
            </div>

            <!-- Botão -->
            <div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-[#0072CE] text-white font-semibold rounded-md hover:bg-[#005a9c] transition text-sm">
                    Entrar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
