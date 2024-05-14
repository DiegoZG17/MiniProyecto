<?php

use Illuminate\Database\Seeder;
use App\Models\Pregunta;
use App\Models\Producto;
use App\Models\Usuario;
use Carbon\Carbon;

class PreguntasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener 10 productos con estado consignado
        $productosConsignados = Producto::where('estado', 'consignado')->take(10)->get();

        foreach ($productosConsignados as $producto) {
            // Seleccionar un usuario para hacer la pregunta (ID del 1 al 5)
            $usuarioPregunta = Usuario::where('id', '>=', 1)->where('id', '<=', 5)->inRandomOrder()->first();

            // Seleccionar un usuario para responder la pregunta (ID del 6 al 10)
            $usuarioRespuesta = Usuario::where('id', '>=', 6)->where('id', '<=', 10)->inRandomOrder()->first();

            // Generar 10 preguntas para cada producto
            for ($i = 1; $i <= 10; $i++) {
                $pregunta = new Pregunta();
                $pregunta->contenido = "Pregunta $i para el producto {$producto->id}";
                $pregunta->usuario_id = $usuarioPregunta->id; // Usuario que hace la pregunta
                $pregunta->producto_id = $producto->id;
                $pregunta->estado = 'pendiente'; // Todas las preguntas se inicializan como pendientes
                $pregunta->fecha_pregunta = Carbon::now();

                // Si es una de las primeras 5 preguntas, generar una respuesta
                if ($i <= 5) {
                    $pregunta->respuesta = "Respuesta para la pregunta $i";
                    $pregunta->fecha_respuesta = Carbon::now();
                    $pregunta->estado = 'respondida';
                    $pregunta->usuario_id = $usuarioRespuesta->id; // Usuario que responde la pregunta
                }

                $pregunta->save();
            }
        }
    }
}
