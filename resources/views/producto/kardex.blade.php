@if (Auth::check() && (Auth::user()->role == '' || Auth::user()->role == 'Supervisor' ))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kardex del Producto</title>
</head>
<body>
    <h1>Kardex del Producto: {{ $producto->nombre }}</h1>
    <p><strong>Fecha de Publicación:</strong> {{ $producto->fecha_publicacion }}</p>
    <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
    
    <h2>Preguntas</h2>
    @if($producto->preguntas->isEmpty())
        <p>No hay preguntas sobre este producto.</p>
    @else
        <ul>
            @foreach($producto->preguntas as $pregunta)
                <li>{{ $pregunta->contenido }} ({{ $pregunta->fecha_pregunta }})</li>
            @endforeach
        </ul>
    @endif

    <h2>Compras</h2>
    @if($compras->isEmpty())
        <p>No se han registrado compras para este producto.</p>
    @else
        <ul>
            @foreach($compras as $compra)
                <li>
                    <!-- Mostrar detalles de cada compra -->
                    Comprado(s) por {{ $compra->usuario->nombre }} el {{ $compra->created_at }}:
                    <ul>
                        @foreach(json_decode($compra->productos) as $productoComprado)
                            @if($productoComprado->id == $producto->id)
                                <li>{{ $productoComprado->nombre }} - Cantidad: {{ $productoComprado->cantidad }}</li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo Supervisor pueden acceder a esta vista.</p>
@endif 