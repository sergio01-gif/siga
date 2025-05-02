@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Anúncios</h2>
    <a href="{{ route('anuncios.create') }}" class="btn btn-primary mb-3">Criar Novo Anúncio</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($anuncios->isEmpty())
        <p>Não há anúncios disponíveis.</p>
    @else
        @foreach($anuncios as $anuncio)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $anuncio->titulo }}</h5>
                    <p class="card-text">{{ $anuncio->conteudo }}</p>
                    <p class="card-text">
                        <small class="text-muted">
                            Publicado em: {{ $anuncio->data_publicacao->format('d/m/Y') }} |
                            Destinatários: {{ ucfirst($anuncio->destinatarios) }}
                        </small>
                    </p>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
