<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceso de Pago</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Proceso de Pago</h1>

        <section class="order-details">
            <h2>Detalles de tu Orden</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('carrito') as $id => $details)
                    <tr>
                        <td>{{ $details['nombre'] }}</td>
                        <td>{{ $details['cantidad'] }}</td>
                        <td>${{ number_format($details['precio'], 2) }}</td>
                        <td>${{ number_format($details['cantidad'] * $details['precio'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="payment-form">
            <h2>Información de Pago</h2>
            <form action="{{ route('compras.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del Titular de la Tarjeta:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="card_number">Número de Tarjeta:</label>
                    <input type="text" id="card_number" name="card_number" required>
                </div>
                <div class="form-group">
                    <label for="expiration_date">Fecha de Expiración:</label>
                    <input type="month" id="expiration_date" name="expiration_date" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" required>
                </div>
                <input type="hidden" name="total" value="{{ number_format(session('total'), 2) }}">
                <button type="submit" class="btn btn-primary">Realizar Pago</button>
            </form>
        </section>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
