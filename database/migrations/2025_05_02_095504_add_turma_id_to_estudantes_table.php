<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('estudantes', function (Blueprint $table) {
            // Adiciona a coluna turma_id e define a foreign key
            $table->unsignedBigInteger('turma_id')->after('curso_id');

            $table->foreign('turma_id')
                ->references('id')
                ->on('turmas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudantes', function (Blueprint $table) {
            // Remove a foreign key e a coluna turma_id
            $table->dropForeign(['turma_id']);
            $table->dropColumn('turma_id');
        });
    }
};
