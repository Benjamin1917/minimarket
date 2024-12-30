<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserta los roles en la tabla 'roles'
        DB::table('roles')->insert([
            ['nombre_rol' => 'Administrador'],
            ['nombre_rol' => 'Trabajador'],
        ]);
    }
}
