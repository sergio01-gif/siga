<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMensalidadesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mensalidades', function (Blueprint $table) {
            $table->string('status')->default('pendente'); // Adicionando a coluna status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('mensalidades', function (Blueprint $table) {
            $table->dropColumn('status'); // Removendo a coluna status caso seja necessário reverter
        });
    }
}
