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
 <h2>Formulario para crear categorias</h2>
 <form action="{{route('categorias.store')}}" method="POST" enctype="application/x-www-form-urlencoded">
  @csrf
  <label for='nombre'>Nombre</label>
  <input type='nombre' name='nombre' id='nombre' required>


  <input type="submit" value="Enviar">
 </form>
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Encargado' o 'Supervisor' pueden acceder a esta vista.</p>
@endif