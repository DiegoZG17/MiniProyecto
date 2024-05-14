<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Vendidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Productos Vendidos</h1>
        <table class="table">
            <thead>
                <tr>
                    
                    <th>Nombre Producto</th>
                    <th>Cantidad Vendida</th>
                    <th>Vendedor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productosVendidos as $producto)
                    <tr>
                        
                        <td>{{ $producto['nombre'] }}</td>
                        <td>{{ $producto['cantidad'] }}</td>
                        <td>{{ $producto['nombre_vendedor'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
