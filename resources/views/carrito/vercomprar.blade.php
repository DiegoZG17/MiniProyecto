@if (Auth::check() && Auth::user()->role == 'Cliente')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Mis Compras</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID de Compra</th>
                    <th>Total</th>
                    <th>Productos</th>
                    <th>Fecha de Compra</th>
                    <th>Subir archivo (5 letras Max.)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                <tr>
                    <td>{{ $compra->id }}</td>
                    <td>${{ number_format($compra->total, 2) }}</td>
                    <td>
                        <ul>
                        @foreach (json_decode($compra->productos, true) as $producto)
                            <li>{{ $producto['nombre'] }} - ${{ number_format($producto['precio'], 2) }}</li>
                        @endforeach
                        </ul>
                    </td>
                    <td>{{ $compra->created_at }}</td>
                    <td>
                        
                    <form method="POST" action="/compras/{{ $compra->id }}/upload" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <input type="hidden" name="compra_id" value="{{ $compra->id }}">
    <button type="submit">Subir comprobante de pago</button>
</form>

</td>

                    
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Cliente' pueden acceder a esta vista.</p>
@endif