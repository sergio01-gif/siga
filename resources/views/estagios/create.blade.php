@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Registrar Estágio</h1>

    @include('components.errors')

    <form action="{{ route('estagios.store') }}" method="POST">
        @include('estagios.partials.form')
    </form>
</div>
@endsection
