@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard - Professor</h1>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold">Olá, {{ auth()->user()->name }}!</h2>
        <p class="mt-2">Aqui você pode visualizar suas turmas, alunos e notas.</p>
        <div class="mt-6">
            <a href="{{ route('professor.turmas') }}" class="text-blue-600 hover:underline">Ver Turmas</a>
        </div>
    </div>
</div>
@endsection
