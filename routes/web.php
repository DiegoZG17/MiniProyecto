<?php


use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ContadorController;
use App\Http\Controllers\InstaladorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagoController;

use App\Http\Controllers\UsuarioController;
use App\Models\Categoria;
use App\Http\Controllers\PuertaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\PreguntaController;
use App\Models\Producto;
use App\Http\Controllers\CarritoController;



Route::get('entrar',[PuertaController::class, 'entrada']);
Route::get('salir',[PuertaController::class, 'salida']);
Route::post('validar',[PuertaController::class, 'valida']);
////
Route::get('login',[UsuarioController::class,'regis'])->name('registrar');

////suarios
Route::get('listar-usuarios',[UsuarioController::class,'index'])->name('lista');


Route::get('crear-usuarios',[UsuarioController::class,'create'])->name('crear');
Route::post('agregar-usuarios',[UsuarioController::class,'store'])->name('alta');
Route::get('editar-usuarios/{usuario}',[UsuarioController::class,'edit'])->name('editar');
Route::post('actualizar-usuarios/{usuario}', [UsuarioController::class, 'update'])->name('actualizar');
Route::put('editar-usuarios/{usuario}', [UsuarioController::class, 'update'])->name('editar');
Route::delete('destruir-usuarios/{usuario}',[UsuarioController::class,'destroy'])->name('destruir2');




////sin validar
Route::post('agregar-usuarios',[UsuarioController::class,'sin'])->name('alta2');



////
Route::get('/',[ProductosController::class,'index2'])->name('lista2');

//productos
Route::get('list-producto',[ProductosController::class,'ver'])->name('verpro');



Route::get('crear-producto',[ProductosController::class,'create'])->name('crearpro');
Route::post('agregar-producto',[ProductosController::class,'store'])->name('altapro');
Route::get('editar-produrcto/{prodcuto}',[ProductosController::class,'edit'])->name('editpo');
Route::get('editar-producto/{producto}',[ProductosController::class,'edit'])->name('editarProducto');
Route::put('actualizar-producto/{producto}', [ProductosController::class, 'update'])->name('actualizarProducto');
Route::delete('eliminarProducto/{producto}', [ProductosController::class, 'destroy'])->name('destruir');
Route::delete('eliminar-producto/{producto}', [ProductosController::class, 'destroy'])->name('eliminarProducto');
Route::get('/producto/{id}', [ProductosController::class, 'showpro'])->name('showpro');

Route::get('/productosPorCategoria/{id}', function ($id) {
    $productos = Producto::where('categoria_id', $id)->get();
    return response()->json($productos);
});


///// pregunta y respuestas


Route::post('/pregunta',[PreguntaController::class,'store3'])->name('store3');
Route::get('/preguntas', [PreguntaController::class, 'index3'])->name('index3');
Route::post('/respuesta/{id}', [PreguntaController::class, 'responder'])->name('responder');





////categoria


Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/crear', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');


Route::post('/categorias/{categoria}', [CategoriaController::class, 'actualizarcate'])->name('actualizarcate');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');

Route::get('/categorias/{categoria}/editar', [CategoriaController::class, 'edit'])->name('categorias.edit');

//categoria


///historial
Route::get('/historial', [UsuarioController::class, 'historial'])->name('historialuse');

////carrito




//Route::post('/carrito/add/{id}', [CarritoController::class, 'add'])->name('carrito.add');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');

Route::get('/checkout', [CarritoController::class, 'checar'])->name('checkout.index');


Route::patch('/carrito/update/{id}', [CarritoController::class, 'update'])->name('carrito.update');

Route::delete('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');
//////carrito2
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'add'])->name('carrito.agregar');
Route::post('/comprar/finalizar', [CarritoController::class, 'finalizePurchase'])->name('comprar.finalizar');




////compra
Route::post('/compras', [CompraController::class, 'store'])->name('compras.store');


Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');


Route::post('/compras/{id}/upload', [CompraController::class, 'subir'])->name('compra.subir');

////contador

Route::get('/listatransacciones', [ContadorController::class, 'transacciones'])->name('transacciones.ver');


Route::get('/listatransacciones/{id}/editar', [ContadorController::class, 'verformu'])->name('transacciones.formu');



Route::put('/listatransacciones/{id}', [ContadorController::class, 'mandarformu'])->name('transacciones.update');
/////pago

Route::get('/misPagos', [PagoController::class, 'index'])->name('ver.pagos');
Route::post('/procesar-pago', [PagoController::class, 'procesarPago']);
Route::get('/listadepagos', [PagoController::class, 'listapagos'])->name('pagos.ver');
///kardex
Route::get('/kardex/{id}', [ProductosController::class, 'verkardex'])->name('kardex.ver');

Route::get('/instalar', [InstaladorController::class, 'instalar']);
