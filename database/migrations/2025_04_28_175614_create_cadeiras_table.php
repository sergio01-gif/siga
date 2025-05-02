<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadeirasTable extends Migration
{
    public function up()
    {
        Schema::create('cadeiras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('carga_horaria');
            $table->integer('semestre');
            $table->text('descricao')->nullable();
            $table->enum('estado', ['ativo', 'inativo'])->default('Ativo');
            $table->timestamps();

            // Integridade referencial
    
        });
    }

    public function down()
    {
        Schema::dropIfExists('cadeiras');
    }
}
