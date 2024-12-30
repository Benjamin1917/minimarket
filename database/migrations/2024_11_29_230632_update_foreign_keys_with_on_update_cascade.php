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
        // Actualizar en la tabla ajuste_stock
        Schema::table('ajuste_stock', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); // Eliminar la clave foránea existente
            $table->foreign('rut_usuario')->references('rut')->on('usuarios')->onUpdate('cascade'); // Añadir la opción onUpdate('cascade')
        });

        // Actualizar en la tabla ingreso_productos
        Schema::table('ingreso_productos', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); // Eliminar la clave foránea existente
            $table->foreign('rut_usuario')->references('rut')->on('usuarios')->onUpdate('cascade'); // Añadir la opción onUpdate('cascade')
        });

        // Actualizar en la tabla ventas
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); // Eliminar la clave foránea existente
            $table->foreign('rut_usuario')->references('rut')->on('usuarios')->onUpdate('cascade'); // Añadir la opción onUpdate('cascade')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir en la tabla ajuste_stock
        Schema::table('ajuste_stock', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); // Eliminar la clave foránea
            $table->foreign('rut_usuario')->references('rut')->on('usuarios'); // Restaurar sin onUpdate('cascade')
        });

        // Revertir en la tabla ingreso_productos
        Schema::table('ingreso_productos', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); // Eliminar la clave foránea
            $table->foreign('rut_usuario')->references('rut')->on('usuarios'); // Restaurar sin onUpdate('cascade')
        });

        // Revertir en la tabla ventas
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); // Eliminar la clave foránea
            $table->foreign('rut_usuario')->references('rut')->on('usuarios'); // Restaurar sin onUpdate('cascade')
        });
    }
};
