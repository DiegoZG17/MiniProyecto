<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; // Asegúrate de tener un modelo Categoria

class CategoriaController extends Controller
{
    public function index()
    {
        // Aquí mostrarías todas las categorías
        $categorias = Categoria::all();

        return view('categorias.vercate', ['categorias' => $categorias]);
    }

    public function create()
    {
        // Aquí mostrarías un formulario para crear una nueva categoría
        return view('categorias.crearcate');
    }

    public function store(Request $request)
    {
        // Aquí guardarías la nueva categoría en la base de datos
        $categoria = new Categoria;
        $categoria->nombre = $request->input('nombre');
        $categoria->save();

        return redirect()->route('categorias.index');
    }

    public function destroy(Categoria $categoria)
    {
        // Aquí eliminarías la categoría de la base de datos
        $categoria->delete();

        return redirect()->route('categorias.index');
    }



    public function actualizarcate(Request $request)
    {
        $categoria = new Categoria;
        $categoria->nombre = $request->nombre;
        $categoria->save();
        $categorias = Categoria::all();

        return view('categorias.vercate', ['categorias' => $categorias]);
    }

    public function edit(Categoria $categoria)
{
    return view('categorias.editar', compact('categoria'));
}
public function update(Request $request, Categoria $categoria)
{
    $categoria->nombre = $request->nombre;
    $categoria->save();

    return redirect()->route('categorias.index');
}
}
