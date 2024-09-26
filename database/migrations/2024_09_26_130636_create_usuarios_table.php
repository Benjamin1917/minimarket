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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->string('rut')->primary(); 
            $table->string('nombre'); 
            $table->string('apellido'); 
            $table->string('password'); 
            $table->unsignedBigInteger('id_rol')->nullable(); 

            // Relación con la tabla roles
            $table->foreign('id_rol')->references('id_rol')->on('roles')->onDelete('set null');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['id_rol']); // Eliminar la clave foránea antes de eliminar la tabla
        });
        Schema::dropIfExists('usuarios'); // Elimina la tabla si existe
    }
};