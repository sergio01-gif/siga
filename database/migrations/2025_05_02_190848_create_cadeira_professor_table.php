<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadeiraProfessorTable extends Migration
{
    public function up()
    {
        Schema::create('cadeira_professor', function (Blueprint $table) {
            $table->id();  // Criação do campo de id (chave primária)
            $table->foreignId('professor_id')->constrained('professores')->onDelete('cascade');  // Chave estrangeira para 'professores'
            $table->foreignId('cadeira_id')->constrained('cadeiras')->onDelete('cascade');  // Chave estrangeira para 'cadeiras'
            $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade');  // Chave estrangeira para 'turmas', se aplicável
            $table->timestamps();  // Campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('cadeira_professor');
    }
}
