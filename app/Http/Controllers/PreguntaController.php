<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pregunta; // Importa el modelo Pregunta correctamente

use App\Models\Categoria;
use App\Models\Producto;

class PreguntaController extends Controller
{
    public function store3(Request $request)
{
    // Aquí guardarías la pregunta en la base de datos
    $pregunta = new Pregunta;
    $categorias = Categoria::all(); // Asume que tienes un modelo llamado 'Categoria'
    $productos = Producto::all(); // Asume que tienes un modelo llamado 'Producto'

    $pregunta->contenido = $request->input('question');
    $pregunta->usuario_id = Auth::user()->id; // Asegúrate de tener autenticación
    $pregunta->producto_id = $request->input('producto_id'); // Obtén el id del producto del request
    $pregunta->save();

    return view('layouts.principalcliente', ['categorias' => $categorias],['productos' => $productos]);
}

    public function index3()
    {
        // Aquí mostrarías todas las preguntas
        $preguntas = Pregunta::all();

        return view('preguntas.respuestas', ['preguntas' => $preguntas]);
    }

    public function responder(Request $request, $id)
{
    // Encuentra la pregunta en la base de datos usando el id
    $pregunta = \App\Models\Pregunta::find($id);

    // Actualiza la respuesta y el estado de la pregunta
    $pregunta->respuesta = $request->input('respuesta');
    $pregunta->estado = 'resuelto';

    // Guarda los cambios en la base de datos
    $pregunta->save();

    // Redirige a donde quieras después de guardar la respuesta
    view('preguntas.respuestas');


}




    
    public function verpre()
    {
        // Aquí mostrarías todas las preguntas
        $preguntas = Pregunta::all();

        return view('preguntas.respuestas', ['preguntas' => $preguntas]);
    }
}
