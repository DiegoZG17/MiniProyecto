<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use Carbon\Carbon;
use App\Models\Categoria;
use App\Models\Usuario;
class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear 10 productos consignados
        for ($i = 1; $i <= 10; $i++) {
            $producto = new Producto();
            $producto->nombre = "producto $i";
            $producto->estado = 'consignado';
            $producto->fecha_publicacion = Carbon::now();
            $producto->motivo = null;
            $producto->fotos = ""; // Debes proporcionar la ruta de la foto
            $producto->descripcion = "Descripción del consignado $i";
            $producto->cantidad = ($i <= 4) ? 100 : rand(1, 30);
            $producto->precio = rand(10, 1000);
            $producto->categoria_id = Categoria::inRandomOrder()->first()->id; // Ajusta esto según tus categorías
            $producto->propietario_id = Usuario::where('id', '>=', 6)->where('id', '<=', 10)->inRandomOrder()->first()->id; // Ajusta esto según tus usuarios
            $producto->save();
        }
        
        // Crear 10 productos propuestos
        for ($i = 1; $i <= 10; $i++) {
            $producto = new Producto();
            $producto->nombre = "producto $i";
            $producto->estado = 'propuesto';
            $producto->fecha_publicacion = Carbon::now();
            $producto->motivo = null;
            $producto->fotos = ""; // Debes proporcionar la ruta de la foto
            $producto->descripcion = "Descripción del propuesto $i";
            $producto->cantidad = rand(1, 100);
            $producto->precio = rand(10, 1000);
            $producto->categoria_id = Categoria::inRandomOrder()->first()->id; // Ajusta esto según tus categorías
            $producto->propietario_id = Usuario::where('id', '>=', 6)->where('id', '<=', 10)->inRandomOrder()->first()->id;// Ajusta esto según tus usuarios
            $producto->save();
        }
    }
}
