<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estagios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudante_id')->constrained('estudantes')->onDelete('cascade');
            $table->string('empresa');
            $table->string('area');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->string('orientador')->nullable();
            $table->enum('status', ['em_andamento', 'concluido', 'cancelado'])->default('em_andamento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estagios');
    }
};
