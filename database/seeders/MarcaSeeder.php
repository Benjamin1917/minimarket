<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marcas')->insert([
            ['nombre_marca' => 'Lays'],
            ['nombre_marca' => 'Pepsi'],
            ['nombre_marca' => 'Lucchetti'],
            ['nombre_marca' => 'Carozzi'],
            ['nombre_marca' => 'Soprole'],
            ['nombre_marca' => 'Costa'],
            ['nombre_marca' => 'Lider'],
            ['nombre_marca' => 'Coca-Cola'],
            ['nombre_marca' => 'Cristal'],
            ['nombre_marca' => 'Escudo'],
            ['nombre_marca' => 'Colún'],
            ['nombre_marca' => 'Nestlé'],
            ['nombre_marca' => 'Quillayes'],
            ['nombre_marca' => 'Doritos'],
            ['nombre_marca' => 'Ambrosoli'],
            ['nombre_marca' => 'San Jorge'],
            ['nombre_marca' => 'La Preferida'],
            ['nombre_marca' => 'Omo'],
            ['nombre_marca' => 'Confort'],
            ['nombre_marca' => 'Ariel'],
            ['nombre_marca' => 'Virutex'],
            ['nombre_marca' => 'Rexona'],
            ['nombre_marca' => 'Dove'],
            ['nombre_marca' => 'Colgate'],
            ['nombre_marca' => 'Ideal'],
            ['nombre_marca' => 'Clorox'],
            ['nombre_marca' => 'Iansa'],
        ]);
    }
}
