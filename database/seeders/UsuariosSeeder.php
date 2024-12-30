<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'rut' => '12345678-9',
                'nombre' => 'Benjamin',
                'apellido' => 'Ortega',
                'password' => Hash::make('admin123'), // Hasheando la contraseña
                'id_rol' => 1, // ID del rol "Administrador"
            ],
            [
                'rut' => '98765432-1',
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'password' => Hash::make('tra321'), // Hasheando la contraseña
                'id_rol' => 2, // ID del rol "Trabajador"
            ]
        ]);
    }
}
