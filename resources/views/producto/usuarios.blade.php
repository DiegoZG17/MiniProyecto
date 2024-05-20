@if (Auth::check() && Auth::user()->role == 'Supervisor')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de ventas por vendedor</title>
</head>
<body>
<table style="width:100%; height:100%;">
<thead>
        <tr>
            <th>ID Vendedor</th>
            <th>Nombre Vendedor</th>
            <th>Fecha de Alta</th>
            <th>Productos en Consignación</th>
            <th>Total Ventas</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ventasPorVendedor as $vendedorId => $venta)
            <tr>
                <td style="vertical-align:middle; text-align:center;">{{$vendedorId}}</td>
                <td style="vertical-align:middle; text-align:center;">{{$venta['nombre_vendedor']}}</td>
                <td style="vertical-align:middle; text-align:center;">{{$venta['fecha_alta']}}</td>
                <td style="vertical-align:middle; text-align:center;">{{$venta['productos_consignados']}}</td>
                <td style="vertical-align:middle; text-align:center;">{{$venta['ventas']}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="vertical-align:middle; text-align:center;">No hay ventas registradas.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Supervisor' pueden acceder a esta vista.</p>
@endif