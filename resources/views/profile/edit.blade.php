@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Perfil</h1>

    <!-- Mensagem de sucesso -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Exibe erros de validação -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $user->nome) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Foto de Perfil</label>
            <input class="form-control" type="file" id="photo" name="photo" accept="image/*">
        </div>

        @if ($user->photo)
            <div class="mb-3">
                <p>Foto Atual:</p>
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de Perfil" class="img-thumbnail" style="max-width: 150px;">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
