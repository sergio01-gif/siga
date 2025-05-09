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
        // Verifique se a coluna 'forma_pagamento' já existe antes de adicionar
        if (!Schema::hasColumn('mensalidades', 'forma_pagamento')) {
            Schema::table('mensalidades', function (Blueprint $table) {
                $table->string('forma_pagamento')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mensalidades', function (Blueprint $table) {
            $table->dropColumn('forma_pagamento');
        });
    }
};
