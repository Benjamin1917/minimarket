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
        Schema::table('detalle_ventas', function (Blueprint $table) {
            // Eliminar la clave foránea actual de 'id_producto'
            $table->dropForeign(['id_producto']);
            
            // Volver a agregar la clave foránea con 'onDelete('cascade')'
            $table->foreign('id_producto')
                  ->references('id_producto')->on('productos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_ventas', function (Blueprint $table) {
            // Eliminar la clave foránea
            $table->dropForeign(['id_producto']);

            $table->foreign('id_producto')
            ->references('id_producto')->on('productos')
            ->onDelete('restrict');
        });
    }
};