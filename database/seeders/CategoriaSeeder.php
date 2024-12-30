<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['categoria' => 'Abarrotes'],
            ['categoria' => 'Bebestibles'],
            ['categoria' => 'Lácteos y Derivados'],
            ['categoria' => 'Carnes y Embutidos'],
            ['categoria' => 'Snacks y Golosinas'],
            ['categoria' => 'Limpieza y Hogar'],
            ['categoria' => 'Cuidado Personal'],
            ['categoria' => 'Congelados'],
            ['categoria' => 'Mascotas'],
        ]);
    }
}
