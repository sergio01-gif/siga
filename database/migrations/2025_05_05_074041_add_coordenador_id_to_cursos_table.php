<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->foreignId('coordenador_id')
                  ->nullable()
                  ->after('nome') // ou onde preferir
                  ->constrained('usuarios')
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropForeign(['coordenador_id']);
            $table->dropColumn('coordenador_id');
        });
    }
};
