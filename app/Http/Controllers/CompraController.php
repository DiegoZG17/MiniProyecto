<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::where('usuario_id', Auth::id())->get();
        return view('carrito.vercomprar', compact('compras'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string',
        'card_number' => 'required|numeric',
        'expiration_date' => 'required|date_format:Y-m',
        'cvv' => 'required|numeric',
        'total' => 'required|numeric'
    ]);

    $compra = new Compra();
    $compra->usuario_id = Auth::id();
    $compra->total = $validatedData['total'];
    $compra->productos = json_encode(session('carrito'));
    
    $compra->save();
    
    // Vaciar el carrito después de realizar la compra
    session()->forget('carrito');
    
    return redirect()->view('carrito.vercomprar')->with('success', 'Compra realizada con éxito.');
}



    
}
