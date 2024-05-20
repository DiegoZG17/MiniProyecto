<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Pago;
use App\Models\Usuario;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class PagoController extends Controller
{
    public function listapagos()
{
    // Obtener las ventas (compras) con estado 'entregado'
    $ventas = Compra::where('estado', 'entregado')->get();
    $vendedoresDisponibles = Usuario::where('role', 'Vendedor')->pluck('nombre', 'id')->toArray(); // Obtener nombres de vendedores disponibles

    $productosVendidos = [];

    foreach ($ventas as $venta) {
        $productosVenta = json_decode($venta->productos, true); // Decodificar los productos de la venta

        foreach ($productosVenta as $detalleProducto) {
            $nombreProducto = $detalleProducto['nombre'];
            $producto = Producto::find($detalleProducto['id']); // Encontrar el producto por ID
            $vendedor = Usuario::find($producto->propietario_id); // Encontrar el vendedor por propietario_id del producto

            $nombreVendedor = $vendedor ? $vendedor->nombre : 'Vendedor no disponible';

            // Agregar el producto vendido a la lista
            $productosVendidos[] = [
                'compra_id' => $venta->id, // Agregar el ID de la compra
                'producto_id' => $detalleProducto['id'], // ID del producto
                'nombre' => $nombreProducto,
                'cantidad' => $detalleProducto['cantidad'],
                'nombre_vendedor' => $nombreVendedor,
                'vendedor_id' => $vendedor ? $vendedor->id : null, // ID del vendedor
                'monto' => $detalleProducto['subtotal'], // Monto del producto
                'estado_vendedor' => $detalleProducto['estado_vendedor'] ?? 'pendiente', // Estado del pago del producto
            ];
        }
    }

    return view('contador.pago', compact('productosVendidos', 'vendedoresDisponibles'));
}





public function procesarPago(Request $request)
{
    $compra = Compra::find($request->compraId);
    $vendedorId = $request->vendedorId;
    $contadorId = Auth::id(); // Suponiendo que el contador está logueado

    // Encontrar el producto específico en la compra
    $productos = json_decode($compra->productos, true);
    $montoTotal = 0;
    $nombreProducto = '';
    foreach ($productos as &$producto) {
        if ($producto['id'] == $request->productoId) {
            $montoTotal = $producto['subtotal'];
            $nombreProducto = $producto['nombre'];
            $producto['estado_vendedor'] = 'pagado'; // Actualizar el estado del vendedor del producto
            break;
        }
    }
    $montoComision = $montoTotal * 0.05;

    // Actualizar los productos en la compra
    $compra->productos = json_encode($productos);
    $compra->save();

    // Crear un nuevo registro en la tabla pagos
    $pago = new Pago();
    $pago->vendedor_id = $vendedorId;
    $pago->contador_id = $contadorId;
    $pago->monto = $montoComision;
    $pago->fecha_pago = Carbon::now();
    $pago->save();

    return response()->json([
        'success' => true,
        'producto' => $nombreProducto,
        'vendedor_nombre' => $compra->vendedor->nombre, // Ajusta esto según tu modelo
        'contador_nombre' => Auth::user()->name,
        'monto' => $montoComision,
        'fecha_pago' => $pago->fecha_pago->format('Y-m-d H:i:s')
    ]);
}


public function index()
{
    $vendedores = Usuario::where('role', 'Vendedor')->pluck('nombre', 'id')->toArray();
    $contadores = Usuario::where('role', 'Contador')->pluck('nombre', 'id')->toArray();

    $pagos = Pago::all()->map(function ($pago) use ($vendedores, $contadores) {
        $pago->vendedor_nombre = $vendedores[$pago->vendedor_id] ?? 'No disponible';
        $pago->contador_nombre = $contadores[$pago->contador_id] ?? 'No disponible';
        return $pago;
    });

    return view('contador.verpagos', compact('pagos'));
}

}
