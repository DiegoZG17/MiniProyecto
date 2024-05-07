<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Formulario de Producto</title>
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
 <h2>Formulario para crear productos</h2>
 <form action="{{route('altapro')}}" method="POST" enctype="application/x-www-form-urlencoded">
  @csrf
  <label for='nombre'>Nombre</label>
  <input type='text' name='nombre' id='nombre' required>

  <label for='estado'>Estado</label>
  
  <select name="estado" id="estado" required>
@if(auth()->user()->role == 'Vendedor')
   <option value="propuesto" selected>Propuesto</option>
@else
   <option value="propuesto">Propuesto</option>
   <option value="consignado">Consignado</option>
@endif
</select>


  <label for='fecha_publicacion'>Fecha de Publicación</label>
  <input type='date' name='fecha_publicacion' id='fecha_publicacion' required>

  

  <label for='descripcion'>Descripción</label>
  <textarea name='descripcion' id='descripcion' required></textarea>

  <label for='votacion_id'>Cantidad</label>
  <input type='number' name='cantidad' id='cantidad' required>

  <label for='precio'>Precio</label>
  <input type='number' name='precio' id='precio' required>

  <label for='fotos'>Foto</label>
<input type='text' name='fotos' id='fotos' value='imagenes/' required>

  <label for='categoria_id'>ID de Categoría</label>
<select name="categoria_id" id="categoria_id" required>
    @foreach ($categorias as $categoria)
        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
    @endforeach
</select>

<label for='propietario_id'>ID de Propietario</label>
<input type="text" name="propietario_id" id="propietario_id" value="{{ Auth::user()->id }}" readonly>


  <input type="submit" value="Enviar">
 </form>
</body>
</html>
