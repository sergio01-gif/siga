<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cadeira_id')->constrained('cadeiras')->onDelete('cascade');
            $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade');
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->date('data_avaliacao');
            $table->decimal('peso', 5, 2)->default(0); // Peso da avaliação, exemplo 20.00%
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacaos');
    }
};
