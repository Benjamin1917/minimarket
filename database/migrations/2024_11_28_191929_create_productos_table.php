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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_marca');
            $table->string('nombre_producto', 30);
            $table->decimal('precio_producto', 10, 2);
            $table->integer('cantidad_stock');
            $table->timestamps();

            $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
            $table->foreign('id_marca')->references('id_marca')->on('marcas');

            // Restricción única
            $table->unique(['nombre_producto', 'id_marca'], 'unique_nombre_marca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
