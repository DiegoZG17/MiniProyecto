<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class ProductosController extends Controller
{
    public function ver(Request $request)
    {
        // Comprueba si el usuario actual tiene el rol de 'Encargado'
        if (Auth::user()->role == 'Encargado'||'Supervisor') {
            // Si es así, obtén todos los productos
            $productos = Producto::all();
            $numeroDeProductosPropuestos = Producto::where('estado', 'propuesto')->count();
            $numeroDeProductosConsignados = Producto::where('estado', 'consignado')->count();
        } else {
            // Si no, obtén solo los productos del usuario actual
            $productos = Producto::where('propietario_id', auth()->user()->id)->get();
            $numeroDeProductosPropuestos = Producto::where('estado', 'propuesto')->where('propietario_id', auth()->user()->id)->count();
            $numeroDeProductosConsignados = Producto::where('estado', 'consignado')->where('propietario_id', auth()->user()->id)->count();
        }
        
        $usuarioActual = Auth::user();
    
        if($request->expectsJson())
            return response()->json(['productos' => $productos, 'numeroDeProductosPropuestos' => $numeroDeProductosPropuestos, 'numeroDeProductosConsignados' => $numeroDeProductosConsignados]);
        else
        return view('producto.verproducto', compact('productos', 'numeroDeProductosPropuestos', 'numeroDeProductosConsignados', 'usuarioActual'));
    }
    

    



    
    
public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'estado' => 'required',
        'fecha_publicacion' => 'required',
        'descripcion' => 'required',
        'cantidad' => 'required',
        'precio' => 'required',
        'fotos'=> 'required',
        'categoria_id' => 'required',
        'propietario_id' => 'required',
    ]);

    $producto = new Producto;
    $producto->nombre = $request->nombre;
    $producto->estado = $request->estado;
    $producto->fecha_publicacion = $request->fecha_publicacion;
    $producto->descripcion = $request->descripcion;
    $producto->cantidad = $request->cantidad;
    $producto->precio = $request->precio;
    $producto->fotos = $request->fotos; 
    $producto->categoria_id = $request->categoria_id;
    $producto->propietario_id = $request->propietario_id;

    $producto->save();

    return redirect()->route('verpro');
}





public function edit(Producto $producto)
{
    return view('producto.editarProducto', compact('producto'));
}





public function create()
{
    $categorias = Categoria::all();
    $usuarios = Usuario::all();

    return view('producto.crearproducto', compact('categorias', 'usuarios'));
}

public function update(Request $request, Producto $producto)
{
    $request->validate([
        'nombre' => 'required',
        'fecha_publicacion' => 'required',
        'descripcion' => 'required',
        'cantidad' => 'required',
        'precio' => 'required',
        'fotos'=> 'required',
        'categoria_id' => 'required',
        'propietario_id' => 'required',
    ]);

    if(auth()->user()->role != '') {
        // Actualización individual de los campos
        $producto->nombre = $request->nombre;
        $producto->fecha_publicacion = $request->fecha_publicacion;
        $producto->descripcion = $request->descripcion;
        $producto->cantidad = $request->cantidad;
        $producto->fotos = $request->fotos;
        
        $producto->precio = $request->precio;
    }

    if(auth()->user()->role == 'Encargado') {
        $producto->estado = $request->estado;
        $producto->motivo = $request->motivo;
    }

    $producto->save();

    return redirect()->route('verpro')->with('success', 'Producto actualizado con éxito.');
}






    
public function destroy(Producto $producto)
{
    // Recuperar todas las preguntas del producto
    $preguntas = $producto->preguntas;

    // Eliminar las preguntas
    foreach ($preguntas as $pregunta) {
        // Eliminar la pregunta (que incluye su respuesta)
        $pregunta->delete();
    }

    // Eliminar el archivo de imagen, si es necesario
    Storage::delete($producto->fotos);

    // Eliminar el producto de la base de datos
    $producto->delete();

    // Redireccionar o devolver una respuesta adecuada
    return redirect()->route('verpro')->with('success', 'Producto eliminado con éxito');
}








    


public function index2()
{
    $categorias = Categoria::all(); 
    $productos = Producto::all(); 
    $productos = \App\Models\Producto::where('estado', 'consignado')->get();
    return view('nada', ['categorias' => $categorias, 'productos' => $productos]);
}

public function showpro($id)
{
    $producto = \App\Models\Producto::find($id);
    $preguntas = \App\Models\Pregunta::where('producto_id', $id)->get(); 

    // Obtén la ruta de la imagen del producto
    $ruta_imagen = $producto->fotos;

    return view('producto.showproducto', compact('producto', 'preguntas', 'ruta_imagen')); 
}






    
    
}
