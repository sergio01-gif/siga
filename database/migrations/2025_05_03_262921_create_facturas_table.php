<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_factura')->unique();
            $table->unsignedBigInteger('mensalidade_id');
            $table->unsignedBigInteger('estudante_id');
            $table->decimal('valor_pago', 10, 2);
            $table->date('data_pagamento');
            $table->string('forma_pagamento');
            $table->text('observacoes')->nullable();
            $table->timestamps();

            $table->foreign('mensalidade_id')->references('id')->on('mensalidades')->onDelete('cascade');
            $table->foreign('estudante_id')->references('id')->on('estudantes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
}
