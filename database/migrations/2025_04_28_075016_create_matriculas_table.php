<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('estudante_id')->constrained('estudantes')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->foreignId('turma_id')->nullable()->constrained('turmas')->nullOnDelete();
            $table->foreignId('ano_academico_id')->constrained('anos_academicos')->onDelete('cascade');

            $table->date('data_matricula');
            $table->enum('estado', ['ativa', 'cancelada', 'transferida'])->default('ativa');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
};
