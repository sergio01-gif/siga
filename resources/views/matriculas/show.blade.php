@extends('layouts.app')

@section('title', 'Detalhes da Matrícula')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detalhes da Matrícula</h4>
            <button onclick="window.print()" class="btn btn-light btn-sm d-print-none">
                🖨️ Imprimir
            </button>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Nome do Estudante:</strong>
                    <p>{{ $matricula->estudante->nome }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Curso:</strong>
                    <p>{{ $matricula->curso ? $matricula->curso->nome : 'N/A' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Turma:</strong>
                    <p>{{ $matricula->turma->nome }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Ano Académico:</strong>
                    <p>{{ $matricula->anoAcademico ? $matricula->anoAcademico->ano : 'N/A' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Data da Matrícula:</strong>
                    <p>{{ \Carbon\Carbon::parse($matricula->data_matricula)->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Estado:</strong>
                    <p class="text-capitalize">{{ $matricula->estado }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            -webkit-print-color-adjust: exact;
        }

        .card-header {
            background-color: #0d6efd !important;
            color: white !important;
        }

        .btn {
            display: none !important;
        }

        .d-print-none {
            display: none !important;
        }

        .card {
            box-shadow: none !important;
            border: none !important;
        }

        .container {
            margin: 0;
            padding: 0;
            width: 100%;
        }
    }
</style>
@endsection
