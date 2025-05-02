<!-- resources/views/professores/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalhes do Professor</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $professor->nome }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $professor->email }}</p>
                <p class="card-text"><strong>Telefone:</strong> {{ $professor->telefone }}</p>
                <p class="card-text"><strong>Especialidade:</strong> {{ $professor->especialidade }}</p>
                <p class="card-text"><strong>Documento de Identificação:</strong> {{ $professor->documento_identificacao }}</p>
                <p class="card-text"><strong>Tipo de Contratação:</strong> {{ $professor->tipo_contratacao }}</p>
                <p class="card-text"><strong>Cadeiras:</strong></p>
                <ul>
                    @foreach($professor->cadeiras as $cadeira)
                        <li>{{ $cadeira->nome }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('professores.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
@endsection
