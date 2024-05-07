<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUsuarioRequest;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\User;
use App\Models\Producto;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) //listar
{
    $usuarios = Usuario::all();
    $numeroDeUsuarios = Usuario::count();

    if($request->expectsJson())
        return response()->json(['usuarios' => $usuarios, 'numeroDeUsuarios' => $numeroDeUsuarios]);
    else
        return view('listado', compact('usuarios', 'numeroDeUsuarios'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) //crear 1
    {
        return view('crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        if( is_null(Auth::user()) ){
            echo "primero debes iniciar";
        }else{
            echo "nombre:" . $usuario->nombre . "<br>";
            echo "apellido_paterno:" . $usuario->apellido_paterno . "<br>";
            echo "apellido_materno:" . $usuario->apellido_materno . "<br>";
            echo "genero:" . $usuario->genero . "<br>";    

        }

    }

    public function store(Request $request)
    {
        
        $request->validate([

            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'genero' => 'required',
            'correo' => 'required|email|unique:usuarios',
            'clave' => 'required|min:8',
            
        ]);
    
        // Crear un nuevo usuario
        $nuevo = new Usuario();
        $nuevo->nombre = $request->nombre;
        $nuevo->apellido_paterno = $request->apellido_paterno;
        $nuevo->apellido_materno = $request->apellido_materno;
        $nuevo->genero = $request->genero;
        $nuevo->correo = $request->correo;
        $nuevo->clave = Hash::make($request->clave);  // Encriptar la contraseña
        
        $nuevo->save();

        $usuarios = Usuario::all();
    
        // Redirigir a la lista de usuarios
        return view('listado', compact('usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('editar',compact('usuario'));
    }

    public function update(Request $request, $id)
{
    // Encuentra el usuario por su ID
    $usuario = usuario::findOrFail($id);

    // Actualiza los campos del usuario
    $usuario->correo = $request->correo;
    $usuario->nombre = $request->nombre;
    $usuario->apellido_paterno = $request->apellido_paterno;
    $usuario->apellido_materno = $request->apellido_materno;
    $usuario->genero = $request->genero;
    $usuario->role = $request->role;

    // Si se proporcionó una nueva contraseña, actualízala
    if ($request->filled('clave')) {
        $usuario->clave = Hash::make($request->clave);
    }

    // Guarda los cambios en la base de datos
    $usuario->save();

    // Redirige al usuario a una página de éxito o de vuelta al formulario
    return redirect()->route('lista');
}


    /**
     * Update the specified resource in storage.
     */
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
{
    
    $ruta_imagen = $producto->fotos;

    // Verifica si el archivo existe
    if (file_exists($ruta_imagen)) {
        // Elimina el archivo de imagen
        unlink($ruta_imagen);
    }

    
    $producto->delete();

    return redirect(route('lista'));
}

    /////

    public function sin(Request $request)
    {
        
        $request->validate([

            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'genero' => 'required',
            'correo' => 'required|email|unique:usuarios',
            'clave' => 'required|min:8',
            
        ]);
    
        // Crear un nuevo usuario
        $nuevo = new Usuario();
        $nuevo->nombre = $request->nombre;
        $nuevo->apellido_paterno = $request->apellido_paterno;
        $nuevo->apellido_materno = $request->apellido_materno;
        $nuevo->genero = $request->genero;
        $nuevo->correo = $request->correo;
        $nuevo->clave = Hash::make($request->clave);  // Encriptar la contraseña
        
        $nuevo->save();
    
        // 
        return view ("welcome");



    }

    public function regis(Usuario $usuario)
    {
        
        return view ("welcome");
    }

    public function historial()
    {
        $usuarios = Usuario::withCount(['productos' => function ($query) {
            $query->where('estado', 'consignado');
        }])->get();

        return view('producto.usuarios', ['usuarios' => $usuarios]);
    }





}
