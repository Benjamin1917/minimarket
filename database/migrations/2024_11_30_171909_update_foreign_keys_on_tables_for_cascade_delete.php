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
            $table->dropForeign(['rut_usuario']); 
            $table->foreign('rut_usuario')
                  ->references('rut')->on('usuarios')
                  ->onDelete('cascade');
        });

        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); 
            $table->foreign('rut_usuario')
                  ->references('rut')->on('usuarios')
                  ->onDelete('cascade');
        });

        Schema::table('ajuste_stock', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); 
            $table->foreign('rut_usuario')
                  ->references('rut')->on('usuarios')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingreso_productos', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); 
            $table->foreign('rut_usuario')
                  ->references('rut')->on('usuarios')
                  ->onDelete('restrict');
        });

        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); 
            $table->foreign('rut_usuario')
                  ->references('rut')->on('usuarios')
                  ->onDelete('restrict');
        });

        Schema::table('ajuste_stock', function (Blueprint $table) {
            $table->dropForeign(['rut_usuario']); 
            $table->foreign('rut_usuario')
                  ->references('rut')->on('usuarios')
                  ->onDelete('restrict');
        });
    }
};
