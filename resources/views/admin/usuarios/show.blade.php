@extends('layouts.app')

@section('content')
    <h1>Detalhes do Usuário</h1>
    <p><strong>Nome:</strong> {{ $usuario->nome }}</p>
    <p><strong>Email:</strong> {{ $usuario->email }}</p>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
