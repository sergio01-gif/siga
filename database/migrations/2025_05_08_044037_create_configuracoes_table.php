<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('configuracoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_instituicao');
            $table->string('sigla')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->text('endereco')->nullable();
            $table->string('moeda')->default('MZN');
            $table->string('idioma')->default('pt');
            $table->string('logo')->nullable();
            $table->string('tema')->default('claro');
            $table->foreignId('ano_lectivo_ativo')->nullable()->constrained('anos_academicos')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configuracoes');
    }
};
