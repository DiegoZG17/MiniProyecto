<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Compra;
class ContadorController extends Controller
{
    public function transacciones()
    {
        $compras = Compra::all();
        return view('contador.vertra', compact('compras'));
    }

    public function verformu($id)
    {
        $compra = Compra::find($id);
        return view('contador.editartrans', compact('compra'));
    }

    public function mandarformu(Request $request, $id)
{
    $compra = Compra::find($id);
    $compra->usuario_id = $request->usuario_id;
    $compra->total = $request->total;

    // Verificar si $request->productos es un texto JSON válido
    $productos = json_decode($request->productos, true);
    if (json_last_error() == JSON_ERROR_NONE) {
        // Si es un texto JSON válido, asignarlo a $compra->productos
        $compra->productos = $request->productos;
    } else {
        // Si no es un texto JSON válido, manejar el error como prefieras
        return redirect()->back()->withErrors(['productos' => 'El campo productos debe ser un texto JSON válido.']);
    }

    $compra->estado = $request->estado;
    $compra->pago = $request->pago;
    $compra->save();

    $compras = Compra::all();
    return redirect()->route('transacciones.ver')->with('compras', $compras);
}






}
