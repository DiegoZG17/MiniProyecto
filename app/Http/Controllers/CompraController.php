<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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
        return redirect()->route('compras.index')->with('success', 'Compra realizada con éxito.');
    
        
    }
    

    public function subir(Request $request, $id)
    {
        $compra = Compra::find($id);
        if (!$compra) {
            return response()->json(['error' => 'Compra no encontrada para el ID: ' . $id], 404);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            if (!Storage::exists('public/vouchers')) {
                Storage::makeDirectory('public/vouchers');
            }
            $picture = date('His').'_'.$fileName;

            $file->move(public_path('vouchers/'), $picture);

            // Almacenar el nombre del archivo modificado en la base de datos
            $compra->pago = $picture;
            $compra->save();
            $compras = Compra::where('usuario_id', Auth::id())->get();

            return view('carrito.vercomprar', compact('compras'));
        } else {
            return response()->json(['error' => 'No se ha seleccionado ningún archivo.'], 400);
        }
    }
}