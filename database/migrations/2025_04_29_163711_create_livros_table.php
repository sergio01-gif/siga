<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor')->nullable();
            $table->string('categoria')->nullable();
            $table->string('codigo_exemplar')->unique();
            $table->integer('quantidade_total');
            $table->integer('quantidade_disponivel');
            $table->year('ano_publicacao')->nullable();
            $table->string('editora')->nullable();
            $table->enum('estado', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('livros');
    }
};
