<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livro_id')->constrained('livros')->onDelete('cascade');
            $table->foreignId('estudante_id')->constrained('estudantes')->onDelete('cascade');
            $table->date('data_emprestimo');
            $table->date('data_devolucao_prevista');
            $table->date('data_devolucao_real')->nullable();
            $table->enum('estado', ['pendente', 'devolvido', 'atrasado'])->default('pendente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emprestimos');
    }
};
