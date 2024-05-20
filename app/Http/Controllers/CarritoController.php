<?php

namespace App\Http\Controllers;

use App\Models\Compra;
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
    
            // Agrega el producto al carrito
            $carrito = new Carrito();
            $carrito->usuario_id = Auth::id();
            $carrito->producto_id = $producto->id;
            $carrito->cantidad = $cantidadComprar;
            $carrito->save();

            return redirect()->route('carrito.index');
        } else {
            // No hay suficiente producto en stock
            return response()->json([
                'error' => 'No hay suficiente producto en stock.'
            ], 400);
        }
    }

    public function finalizePurchase()
    {
        // Obtener todos los productos en el carrito del usuario
        $productosEnCarrito = Carrito::where('usuario_id', Auth::id())->get();
        $productosJson = [];

        foreach ($productosEnCarrito as $item) {
            $producto = Producto::find($item->producto_id);
            $productosJson[] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $item->cantidad,
                'subtotal' => $producto->precio * $item->cantidad,
                'estado_vendedor' => 'pendiente'
            ];
        }

        // Crear una nueva compra
        $compra = new Compra();
        $compra->usuario_id = Auth::id();
        $compra->total = array_sum(array_column($productosJson, 'subtotal'));
        $compra->productos = json_encode($productosJson);
        $compra->estado = 'pendiente';
        $compra->save();

        // Vaciar el carrito después de finalizar la compra
        Carrito::where('usuario_id', Auth::id())->delete();

        return redirect()->route('compras.index')->with('compras', $compra);
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
