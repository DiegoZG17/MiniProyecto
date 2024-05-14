<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function add(Request $request, $id)
{
    $producto = Producto::find($id);

    // Obtén la cantidad que el usuario quiere comprar
    $cantidadComprar = $request->input('cantidad');

    // Verifica si hay suficiente producto en stock
    if ($producto->cantidad >= $cantidadComprar) {
        // Resta la cantidad comprada del stock del producto
        $producto->cantidad -= $cantidadComprar;
        $producto->save();

        $carrito = new Carrito();
        $carrito->usuario_id = Auth::id();
        $carrito->producto_id = $producto->id;
        $carrito->cantidad = $cantidadComprar;
        $carrito->save();

        return redirect()->route('carrito.index');
    } else {
        // No hay suficiente producto en stock
        return redirect()->route('carrito.index')->with('error', 'No hay suficiente producto en stock.');
    }
}

    public function index()
    {
        $carritoItems = Carrito::with('producto')->where('usuario_id', Auth::id())->get();
        return view('carrito.carritoindex', compact('carritoItems'));
    }

    public function remove($id)
    {
        $carrito = Carrito::find($id);
        if ($carrito && $carrito->usuario_id == Auth::id()) {
            $carrito->delete();
        }

        return redirect()->route('carrito.index');
    }

    public function update(Request $request, $id)
{
    $carrito = Carrito::find($id);

    // Verificar que el carrito existe y pertenece al usuario autenticado
    if ($carrito && $carrito->usuario_id == Auth::id()) {
        $cantidad = $request->input('cantidad');
        
        // Asegurarse de que la cantidad no supera el stock disponible
        if ($cantidad > 0 && $cantidad <= $carrito->producto->cantidad) {
            $carrito->cantidad = $cantidad;
            $carrito->save();
            return redirect()->route('carrito.index')->with('success', 'Carrito actualizado correctamente.');
        } else {
            return redirect()->route('carrito.index')->with('error', 'La cantidad solicitada supera el stock disponible.');
        }
    }

    return redirect()->route('carrito.index')->with('error', 'Error al actualizar el carrito.');
}

public function checar()
{
    $carritoItems = \App\Models\Carrito::with('producto') // Asegúrate de que tienes una relación 'producto' en el modelo Carrito
                      ->where('usuario_id', auth()->id())
                      ->get();

    $items = $carritoItems->map(function ($item) {
        return [
            'nombre' => $item->producto->nombre, // Asegúrate de que el modelo Producto tiene un atributo 'nombre'
            'cantidad' => $item->cantidad,
            'precio' => $item->producto->precio, // Asegúrate de que el modelo Producto tiene un atributo 'precio'
            'subtotal' => $item->cantidad * $item->producto->precio
        ];
    });

    $total = $items->sum('subtotal');

    session(['carrito' => $items, 'total' => $total]);

    return view('carrito.vercarrito', ['items' => session('carrito'), 'total' => session('total')]);
}










}
