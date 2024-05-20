<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Formulario para Editar Producto</title>
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
 <h2>Formulario para editar productos</h2>
 <form action="{{route('actualizarProducto', $producto->id)}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <label for='nombre'>Nombre</label>
  <input type='text' name='nombre' id='nombre' value="{{$producto->nombre}}" required>

  @if(auth()->user()->role == 'Encargado')
  <label for='estado'>Estado</label>
  <select name="estado" id="estado" required>
    <option value="propuesto" {{$producto->estado == 'propuesto' ? 'selected' : ''}}>Propuesto</option>
    <option value="consignado" {{$producto->estado == 'consignado' ? 'selected' : ''}}>Consignado</option>
  </select>
  <label for='motivo'>Motivo</label>
  <textarea name='motivo' id='motivo' required>{{$producto->motivo}}</textarea>
  @endif

  <label for='fecha_publicacion'>Fecha de Publicación</label>
  <input type='date' name='fecha_publicacion' id='fecha_publicacion' value="{{$producto->fecha_publicacion}}" required>

  <label for='descripcion'>Descripción</label>
  <textarea name='descripcion' id='descripcion' required>{{$producto->descripcion}}</textarea>

  <label for='cantidad'>Cantidad</label>
  <input type='number' name='cantidad' id='cantidad' value="{{$producto->cantidad}}" required>

  <label for='precio'>Precio</label>
  <input type='number' name='precio' id='precio' value="{{$producto->precio}}" required>

  <label for='fotos'>Foto Actual</label>
  <img src="{{ asset($producto->fotos) }}" alt="Foto del Producto" width="100">
  <label for='fotos'>Actualizar Foto</label>
  <input type='file' name='fotos' id='fotos'>

  <label for='categoria_id'>ID de Categoría</label>
  <input type="text" name="categoria_id" id="categoria_id" value="{{ $producto->categoria_id }}" readonly>

  <label for='propietario_id'>ID de Propietario</label>
  <input type="text" name="propietario_id" id="propietario_id" value="{{ $producto->propietario_id }}" readonly>

  <input type="submit" value="Actualizar">
 </form>
</body>
</html>
