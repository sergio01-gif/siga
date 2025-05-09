<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anos_academicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique(); // Exemplo: 2024/2025
            $table->date('inicio');
            $table->date('fim');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anos_academicos');
    }
};
