<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ajuste_stock', function (Blueprint $table) {
            $table->id('id_ajuste');
            $table->unsignedBigInteger('id_producto');
            $table->string('rut_usuario');
            $table->integer('cantidad');
            $table->string('tipo_ajuste');
            $table->date('fecha');
            $table->string('motivo');
            $table->timestamps();

            $table->foreign('id_producto')->references('id_producto')->on('productos');
            $table->foreign('rut_usuario')->references('rut')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuste_stock');
    }
};
