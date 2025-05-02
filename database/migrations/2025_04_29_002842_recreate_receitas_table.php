<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Criar a tabela 'receitas'
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->decimal('valor', 10, 2);
            $table->date('data_recebimento');
            $table->unsignedBigInteger('categoria_id');  // Chave estrangeira para 'categorias'
            $table->unsignedBigInteger('estudante_id')->nullable();  // Chave estrangeira para 'estudantes'
            $table->text('observacao')->nullable();
            $table->timestamps();

            // Definindo a chave estrangeira para 'categoria_id'
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            // Definindo a chave estrangeira para 'estudante_id'
            $table->foreign('estudante_id')->references('id')->on('estudantes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Deletar a tabela 'receitas'
        Schema::dropIfExists('receitas');
    }
}
