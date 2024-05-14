<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
class PagoController extends Controller
{
   
    public function listapagos()
{
    $ventas = Compra::where('estado', 'entregado')->get();
    $productosVendidos = [];

    foreach ($ventas as $venta) {
        $productos = json_decode($venta->productos, true);

        foreach ($productos as $detalleProducto) {
            $nombreProducto = $detalleProducto['nombre']; // Extraemos el nombre del producto desde el JSON

            // Buscar el producto por nombre para obtener los vendedores asociados que tienen el rol de 'Vendedor'
            $productoObj = Producto::where('nombre', $nombreProducto)->first();
            
            if ($productoObj) {
                // Buscamos a todos los vendedores basados en el proprietario_id que tengan el rol 'Vendedor'
                $vendedores = Usuario::where('id', $productoObj->propietario_id)
                                     ->where('role', 'Vendedor')
                                     ->get();

                $nombresVendedores = $vendedores->pluck('nombre')->toArray();

                $nombreVendedor = !empty($nombresVendedores) ? implode(", ", $nombresVendedores) : 'Vendedor no disponible';
            } else {
                $nombreVendedor = 'Producto no registrado';
            }

            $productosVendidos[] = [
                'nombre' => $nombreProducto,
                'cantidad' => $detalleProducto['cantidad'],
                'nombre_vendedor' => $nombreVendedor,
            ];
        }
    }

    return view('contador.pago', compact('productosVendidos'));
}


}
