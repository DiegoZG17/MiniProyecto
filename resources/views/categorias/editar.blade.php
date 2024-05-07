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
 <h2>Formulario para editar categorías</h2>
 <form action="{{route('categorias.update', $categoria)}}" method="POST" enctype="application/x-www-form-urlencoded">
  @csrf
  @method('PUT')
  <label for='nombre'>Nombre</label>
  <input type='text' name='nombre' id='nombre' value="{{ $categoria->nombre }}" required>

  <input type="submit" value="Actualizar">
 </form>
</body>
</html>
