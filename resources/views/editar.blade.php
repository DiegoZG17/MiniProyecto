@if (Auth::check() && (Auth::user()->role == 'Encargado' || Auth::user()->role == 'Supervisor'))
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Formulario para Editar Usuario</title>
 <style>
  body {
    font-family: Arial, sans-serif;
  }
  form {
    width: 300px;
    margin: 0 auto;
  }
  label {
    display: block;
    margin-top: 10px;
  }
  input, select {
    width: 100%;
    padding: 5px;
    margin-top: 5px;
  }
  input[type="submit"] {
    margin-top: 10px;
  }
 </style>
</head>
<body>
 <h2>Formulario para editar usuarios</h2>
 <form action="{{route('editar', $usuario->id)}}" method="POST" enctype="application/x-www-form-urlencoded">
 
  <label for='correo'>Correo</label>
  <input type='email' name='correo' id='correo' value="{{$usuario->correo}}" required>

  <label for='clave'>Nueva Clave</label>
    <input type='password' name='clave' id='clave'>

   <label for='confirmar_clave'>Confirmar Nueva Clave</label>
  <input type='password' name='confirmar_clave' id='confirmar_clave'>

  <label for='nombre'>Nombre</label>
  <input type='text' name='nombre' id='nombre' value="{{$usuario->nombre}}" required>

  <label for='apellido_paterno'>Apellido Paterno</label>
  <input type='text' name='apellido_paterno' id='apellido_paterno' value="{{$usuario->apellido_paterno}}" required>

  <label for='apellido_materno'>Apellido Materno</label>
  <input type='text' name='apellido_materno' id='apellido_materno' value="{{$usuario->apellido_materno}}" required>

  <label for='correo'>Correo</label>
  <input type='text' name='correo' id='correo' value="{{$usuario->correo}}" required>

  <label for='genero'>Género</label>
  <select name="genero" id="genero" required>
   <option value="Masculino" {{$usuario->genero == 'Masculino' ? 'selected' : ''}}>Masculino</option>
   <option value="Femenino" {{$usuario->genero == 'Femenino' ? 'selected' : ''}}>Femenino</option>
  </select>

  <label for='role'>Rol</label>
  
<select name="role" id="role" required>
@if(auth()->user()->role == 'Encargado')
   <option value="Encargado" {{$usuario->role == 'Encargado' ? 'selected' : ''}}>Encargado</option>
   <option value="Cliente" {{$usuario->role == 'Cliente' ? 'selected' : ''}}>Cliente</option>
   <option value="Contador" {{$usuario->role == 'Contador' ? 'selected' : ''}}>Contador</option>
@else
   <option value="Vendedor" {{$usuario->role == 'Vendedor' ? 'selected' : ''}}>Vendedor</option>
   <option value="Encargado" {{$usuario->role == 'Encargado' ? 'selected' : ''}}>Encargado</option>
   <option value="Supervisor" {{$usuario->role == 'Supervisor' ? 'selected' : ''}}>Supervisor</option>
   <option value="Cliente" {{$usuario->role == 'Cliente' ? 'selected' : ''}}>Cliente</option>
   <option value="Contador" {{$usuario->role == 'Contador' ? 'selected' : ''}}>Contador</option>
@endif
</select>
  @csrf
  @method('PUT')
  <input type="submit" value="Actualizar">
</form>
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Encargado' y 'Supervisor' pueden acceder a esta vista.</p>
@endif