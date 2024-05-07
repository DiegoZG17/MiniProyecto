<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 30%;
            margin: 20px;
        }
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .container {
            padding: 2px 16px;
        }
        .price {
            color: green;
            font-size: 24px;
        }
        .add-to-cart {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            position: sticky;
            top: 0;
            width: 100%;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .username {
            float: right;
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="navbar">
  <a href="#home">Inicio</a>
  <a href="#productos">Productos</a>
  <a href="#contact">Mensaje</a>
  <div class="dropdown">
    <select id="categoriaSelect">
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
        @endforeach
    </select>
  </div>
  <a class="username">Invitado</a>
  <a href="/login" class="logout"><i class='bx bxs-log-out-circle'></i><span class="text">Salir</span></a>
</div>

<div id="productosContainer">
    @forelse ($productos as $producto)
    <div class="card" data-categoria-id="{{ $producto->categoria_id }}">
        <div class="container">
            <h2><b>{{ $producto->nombre }}</b></h2>
            <p>{{ $producto->descripcion }}</p>
            <p>Cantidad: {{ $producto->cantidad }}</p>
            <p class="price">${{ $producto->precio }}</p>
            @if (Auth::check())
                <button class="add-to-cart">Comprar</button>
            @else
                <p>Debes iniciar sesión para comprar.</p>
                <a href="/login" class="add-to-cart disabled" disabled>Iniciar sesión para comprar</a>
            @endif
        </div>
    </div>
    @empty
    <p>No se encontraron productos</p>
    @endforelse
</div>

<script>
document.getElementById('categoriaSelect').addEventListener('change', function() {
    var selectedCategoria = this.value;
    var cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        if (card.getAttribute('data-categoria-id') === selectedCategoria) {
            card.style.display = ''; // Muestra el producto
        } else {
            card.style.display = 'none'; // Oculta el producto
        }
    });
});
</script>
</body>
</html>
