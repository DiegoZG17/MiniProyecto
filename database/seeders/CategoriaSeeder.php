<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nueva = new Categoria();
        $nueva->nombre="Electronica";
        $nueva->save();
        $nueva = new Categoria();
        $nueva->nombre="Hogar";
        $nueva->save();

        $nueva = new Categoria();
        $nueva->nombre="Juegos";
        $nueva->save();

    }
}
