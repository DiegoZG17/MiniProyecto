@if (Auth::check() && (Auth::user()->role == 'Contador' ))
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Editar Compra</title>
 <link rel="stylesheet" href="{{asset('css/tabla.css')}}">
</head>
<body>
  
 <div class="container">
 <form action="{{route('transacciones.update', $compra->id)}}" method="POST">
    @csrf
    @method('PUT')
    
    <label for="usuario_id">Usuario ID:</label><br>
    <input type="text" id="usuario_id" name="usuario_id" value="{{$compra->usuario_id}}" readonly><br>
    <input type="hidden" name="usuario_id" value="{{$compra->usuario_id}}">
    
    <label for="total">Total:</label><br>
    <input type="text" id="total" name="total" value="{{$compra->total}}" readonly><br>
    <input type="hidden" name="total" value="{{$compra->total}}">
    
    <label for="productos">Productos:</label><br>
    @foreach(json_decode($compra->productos, true) as $producto)
        <input type="text" id="productos" name="productos" value="{{$producto['nombre']}}" readonly><br>
    @endforeach
    <input type="hidden" name="productos" value="{{$compra->productos}}">
    
    <label for="estado">Estado:</label><br>
    <select id="estado" name="estado">
      <option value="pendiente" {{ $compra->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
      <option value="entregado" {{ $compra->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
    </select><br>
    
    <label for="pago">Pago:</label><br>
    <input type="text" id="pago" name="pago" value="{{$compra->pago}}" readonly><br>
    <input type="hidden" name="pago" value="{{$compra->pago}}">
    
    <input type="submit" value="Guardar cambios">
</form>
 </div>
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Contador' pueden acceder a esta vista.</p>
@endif