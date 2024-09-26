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
        Schema::create('ingreso_productos', function (Blueprint $table) {
            $table->id('id_ingreso');
            $table->unsignedBigInteger('id_proveedor');
            $table->unsignedBigInteger('id_producto');
            $table->string('rut_usuario');
            $table->date('fecha_ingreso');
            $table->integer('cantidad_ingresada');
            $table->timestamps();

            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores');
            $table->foreign('id_producto')->references('id_producto')->on('productos');
            $table->foreign('rut_usuario')->references('rut')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingreso_productos');
    }
};