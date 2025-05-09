<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // Ex: Turma A
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->foreignId('ano_academico_id')->constrained('anos_academicos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('turmas');
    }
};
