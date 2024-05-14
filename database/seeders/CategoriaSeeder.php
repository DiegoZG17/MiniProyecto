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
        $nueva->nombre="Perros";
        $nueva->save();

        $nueva = new Categoria();
        $nueva->nombre="Gatos";
        $nueva->save();

        $nueva = new Categoria();
        $nueva->nombre="Peces";
        $nueva->save();

        $nueva = new Categoria();
        $nueva->nombre="Reptiles";
        $nueva->save();

        $nueva = new Categoria();
        $nueva->nombre="Otras mascotas";
        $nueva->save();
    }
}
