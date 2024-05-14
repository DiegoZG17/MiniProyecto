<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\CategoriaController;
use App\Models\Categoria;

use App\Models\Producto;

class PuertaController extends Controller
{
    public function entrada(Request $request){
      return view('welcome');
    }

    public function salida(){
        Auth::logout(); 
        $pagina = <<<PAGINA
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8" />
 <title>title</title>
</head>
<body>
  Vuelve pronto
</body>
</html>
PAGINA;
        echo $pagina;
    }

    public function valida(Request $request){
      $nombre_usuario =  $request->input('nombre');
      $clave_escrita  = $request->input('clave');
      
      $encontrado = Usuario::where('correo', $nombre_usuario)->first();
      
      if( is_null($encontrado) ){
        if ($request->expectsJson()){
          return response()->json(['error'=>'Usuario no existe'] );
         }else{
          echo " USUARIO no existe. ";
         }

      } 
      else{
        if(Hash::check($clave_escrita,$encontrado->clave)){

        $token = Str::random();
        $encontrado->token = $token ;
        $encontrado->save();


         if ($request->expectsJson()){
          return response()->json($encontrado );
         }else{
          Auth::login($encontrado);
          $categorias = Categoria::all();
          $productos = Producto::all();
$productos = \App\Models\Producto::where('estado', 'consignado')->get();

          switch ($encontrado->role) {
            case 'Cliente':
              return view('layouts.principalcliente',['categorias' => $categorias,'productos' => $productos]);
              # code...
              break;
            case 'Encargado':
              return view('bienvenido');
              # code...
              break;

             case 'Supervisor':
              return view('layouts.supervisor');
              # code...
              break;

              case 'Vendedor':
                return view('layouts.Vendedor');

                break;

              case 'Contador':
                return view('contador.iniciocontador');
          }


          return redirect('/login');
         }

        }else{
          if ($request->expectsJson()){
            return response()->json(['error'=>'Credenciales incorrectas'] );
           }else{
            echo "Credenciales incorrectas";
          }
  
        }
        }
    }
} 
