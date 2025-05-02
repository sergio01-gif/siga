<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id(); // Criação da chave primária
            $table->string('titulo'); // Coluna para o título do livro
            $table->foreignId('autor_id') // Coluna de chave estrangeira para autores
                  ->constrained('autores') // Relaciona com a tabela 'autores'
                  ->onDelete('cascade'); // Quando o autor for deletado, os livros também serão deletados
            $table->foreignId('categoria_id') // Coluna de chave estrangeira para categorias
                  ->constrained('categorias') // Relaciona com a tabela 'categorias'
                  ->onDelete('cascade'); // Quando a categoria for deletada, os livros também serão deletados
            $table->date('data_publicacao'); // Data de publicação
            $table->integer('quantidade'); // Quantidade de livros disponíveis
            $table->timestamps(); // Created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Exclui a tabela 'livros' caso a migração seja revertida
        Schema::dropIfExists('livros');
    }
};
