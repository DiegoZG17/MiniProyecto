<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de usuario</title>
</head>
<body>
<table style="width:100%; height:100%;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha de Registro</th>
            <th>Productos Consignados</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($usuarios as $usuario)
            @if ($usuario->rol != 'Cliente')
                <tr>
                    <td style="vertical-align:middle; text-align:center;"> {{$usuario->id}} </td>
                    <td style="vertical-align:middle; text-align:center;"> {{$usuario->nombre}} </td>
                    <td style="vertical-align:middle; text-align:center;"> {{$usuario->created_at}} </td>
                    <td style="vertical-align:middle; text-align:center;"> {{$usuario->productos->where('estado', 'consignado')->count()}} </td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="4" style="vertical-align:middle; text-align:center;">No hay usuarios con productos consignados.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
