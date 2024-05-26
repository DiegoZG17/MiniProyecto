<!DOCTYPE html>
<html>
<head>
    <title>Mis Pagos</title>
</head>
<body>
    <div class="container">
        <!-- Tabla de pagos -->
        <table id="tablaPagos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vendedor</th>
                    <th>Contador</th>
                    <th>Monto</th>
                    <th>Fecha de Pago</th>
                    
                    <th>Fecha de Actualización</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pagos as $pago)
                    <tr>
                        <td>{{ $pago->id }}</td>
                        <td>{{ $pago->vendedor_nombre }}</td>
                        <td>{{ $pago->contador_nombre }}</td>
                        <td>{{ $pago->monto }}</td>
                        <td>{{ $pago->fecha_pago }}</td>
                        
                        <td>{{ $pago->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
