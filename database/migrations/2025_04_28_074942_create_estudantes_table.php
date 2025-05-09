<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estudantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->nullable()->unique();
            $table->string('telefone')->unique();
            $table->date('data_nascimento')->nullable();
            $table->enum('genero', ['masculino', 'feminino', 'outro'])->nullable();
            $table->string('morada')->nullable();
            $table->enum('tipo_documento', ['BI', 'Passaporte', 'DIRE', 'Outro'])->nullable();
            $table->string('numero_documento')->nullable();

            $table->foreignId('curso_id')->nullable()->constrained('cursos')->nullOnDelete();
            $table->foreignId('turma_id')->nullable()->constrained('turmas')->nullOnDelete();
            $table->foreignId('ano_lectivo_id')->nullable()->constrained('anos_academicos')->nullOnDelete();

            $table->enum('estado', ['ativo', 'suspenso', 'transferido'])->default('ativo');
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudantes');
    }
};
