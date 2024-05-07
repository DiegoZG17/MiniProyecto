<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Asegúrate de enlazar tu archivo CSS apropiado -->
</head>
<body>
    <div class="container">
        <h1>Carrito de Compras</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($carritoItems as $item)
                    <tr>
                        <td>{{ $item->producto->nombre }}</td>
                        <td>${{ number_format($item->producto->precio, 2) }}</td>
                        <td>
                        <form action="{{ route('carrito.update', $item->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" max="{{ $item->producto->cantidad }}">
    <button type="submit">Actualizar</button>
</form>

                        </td>
                        <td>${{ number_format($item->cantidad * $item->producto->precio, 2) }}</td>
                        <td>
                        <form action="{{ route('carrito.remove', $item->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tu carrito está vacío.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($carritoItems->isNotEmpty())
            <div class="checkout">
                <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceder al Pago</a>
            </div>
        @endif
    </div>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Asegúrate de enlazar tu archivo JS apropiado -->
</body>
</html>
