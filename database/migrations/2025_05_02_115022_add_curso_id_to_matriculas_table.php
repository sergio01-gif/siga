<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCursoIdToMatriculasTable extends Migration
{
    public function up()
    {
        Schema::table('matriculas', function (Blueprint $table) {
            // Adiciona a coluna curso_id
            $table->unsignedBigInteger('curso_id')->nullable();

            // Define a chave estrangeira para a tabela cursos
            $table->foreign('curso_id')
                  ->references('id')
                  ->on('cursos')
                  ->onDelete('set null'); // Define o que acontece ao excluir o curso. Pode ser 'cascade', 'set null', etc.
        });
    }

    public function down()
    {
        Schema::table('matriculas', function (Blueprint $table) {
            // Remove a chave estrangeira
            $table->dropForeign(['curso_id']);
            
            // Remove a coluna curso_id
            $table->dropColumn('curso_id');
        });
    }
}
