<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensalidadesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudante_id');
            $table->string('mes_referencia'); // Janeiro, Fevereiro, etc.
            $table->date('data_vencimento');
            $table->decimal('valor', 10, 2); // Exemplo: 1500.00
            $table->enum('forma_pagamento', ['dinheiro', 'mpesa', 'emola', 'cartao', 'transferencia', 'entidade_referencia']);
            $table->string('entidade_referencia')->nullable(); // Preenchido somente se usar entidade referência
            $table->timestamps();

            // Relação com tabela estudantes
            $table->foreign('estudante_id')->references('id')->on('estudantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mensalidades');
    }
}
