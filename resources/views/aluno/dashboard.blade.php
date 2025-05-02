@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard - Aluno</h1>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold">Bem-vindo, {{ auth()->user()->name }}!</h2>
        <p class="mt-2">Aqui você pode acompanhar suas aulas, notas e mais.</p>
        <div class="mt-6">
            <a href="{{ route('aluno.cursos') }}" class="text-blue-600 hover:underline">Ver Cursos</a>
        </div>
    </div>
</div>
@endsection
