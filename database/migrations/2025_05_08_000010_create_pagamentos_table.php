<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudante_id')->constrained('estudantes')->onDelete('cascade');
            $table->foreignId('mensalidade_id')->constrained('mensalidades')->onDelete('cascade');
            $table->enum('metodo', ['mpesa', 'emola', 'banco']);
            $table->string('entidade'); // código fixo da entidade
            $table->string('referencia')->unique(); // referência única para o pagamento
            $table->decimal('valor', 10, 2);
            $table->enum('estado', ['pendente', 'pago', 'falhado'])->default('pendente');
            $table->string('comprovativo')->nullable(); // opcional para upload manual
            $table->timestamp('data_pagamento')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
};
