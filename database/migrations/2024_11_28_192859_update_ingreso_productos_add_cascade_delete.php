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
        Schema::table('ingreso_productos', function (Blueprint $table) {
            // Modificar la clave foránea rut_usuario
            $table->dropForeign(['rut_usuario']);
            $table->foreign('rut_usuario')->references('rut')->on('usuarios')->onDelete('cascade');

            // Eliminar las claves foráneas existentes
            $table->dropForeign(['id_producto']);
            $table->dropForeign(['id_proveedor']);
            
            // Volver a agregar las claves foráneas con 'onDelete('cascade')'
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingreso_productos', function (Blueprint $table) {
            // Eliminar las claves foráneas
            $table->dropForeign(['id_producto']);
            $table->dropForeign(['id_proveedor']);
            $table->dropForeign(['rut_usuario']);
        });
    }
};