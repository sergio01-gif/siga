<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessoresTable extends Migration
{
    public function up()
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->id();  // Criação do campo de id (chave primária)
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('telefone');
            $table->string('especialidade');
            $table->string('documento_identificacao');
            $table->string('tipo_contratacao');
            $table->string('foto')->nullable();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');  // Correção para tabela 'usuarios'
            $table->timestamps();  // Campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('professores');
    }
}
