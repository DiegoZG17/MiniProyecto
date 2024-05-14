@if (Auth::check() && (Auth::user()->role == 'Encargado' || Auth::user()->role == 'Supervisor'))
<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Formulario de Usuario</title>
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
 <h2>Formulario para crear usuarios</h2>
 <form action="{{route('alta2')}}" method="POST" enctype="application/x-www-form-urlencoded">
  @csrf
  <label for='correo'>Correo</label>
  <input type='email' name='correo' id='correo' required>

  <label for='clave'>Clave</label>
  <input type='password' name='clave' id='clave' required>

  <label for='nombre'>Nombre</label>
  <input type='text' name='nombre' id='nombre' required>

  <label for='apellido_paterno'>Apellido Paterno</label>
  <input type='text' name='apellido_paterno' id='apellido_paterno' required>

  <label for='apellido_materno'>Apellido Materno</label>
  <input type='text' name='apellido_materno' id='apellido_materno' required>

  <label for='genero'>Género</label>
  <select name="genero" id="genero" required>
   <option value="Masculino">Masculino</option>
   <option value="Femenino">Femenino</option>
  </select>


  <input type="submit" value="Enviar">
 </form>
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Encargado' y Supervisor pueden acceder a esta vista.</p>
@endif