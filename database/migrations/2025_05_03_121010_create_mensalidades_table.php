<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->id(); // ID da mensalidade
            $table->unsignedBigInteger('estudante_id'); // Relacionamento com estudante
            $table->string('mes_referencia'); // Janeiro, Fevereiro, etc.
            $table->date('data_vencimento'); // Data de vencimento
            $table->decimal('valor', 10, 2); // Valor da mensalidade
            $table->enum('forma_pagamento', ['dinheiro', 'mpesa', 'emola', 'cartao', 'transferencia', 'entidade_referencia']); // Forma de pagamento
            $table->string('entidade_referencia')->nullable(); // Preenchido apenas se usar entidade referência
            $table->enum('status', ['pendente', 'pago', 'vencido'])->default('pendente'); // Status da mensalidade (pendente, pago, vencido)
            $table->timestamps(); // Created_at e updated_at

            // Relação com a tabela estudantes
            $table->foreign('estudante_id')->references('id')->on('estudantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensalidades');
    }
}
