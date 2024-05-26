@if (Auth::check() && Auth::user()->role == 'Cliente')
<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
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
        .productos-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="navbar">
    <a href="#home">Inicio</a>
    <a href="/carrito">CARRITO</a>
    <a href="/compras">Compras</a>
    <a href="#contact">Mensaje</a>
    <select id="categoriaSelect">
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
        @endforeach
    </select>
    <a class="username">{{ Auth::user()->nombre }}</a>
    <a href="/salir" class="logout">Salir</a>
</div>

<!-- HTML para mostrar productos -->
<div id="productosContainer" class="productos-container">
    @forelse ($productos as $producto)
    <div class="card" data-categoria-id="{{ $producto->categoria_id }}">
        <div class="container">
            <h2><b>{{ $producto->nombre }}</b></h2> 
            <p>{{ $producto->descripcion }}</p>
            <p class="price">${{ $producto->precio }}</p>
            <button class="add-to-cart" onclick="window.location.href='{{ route('showpro', $producto->id) }}'">Ver detalles</button>
        </div>
    </div>
    @empty
    <p>No se encontraron productos.</p>
    @endforelse
</div>

<!-- JavaScript para filtrar productos basado en la selección de categoría -->
<script>
document.getElementById('categoriaSelect').addEventListener('change', function() {
    var selectedCategoria = this.value;
    var cards = document.querySelectorAll('.card');
    
    cards.forEach(card => {
        if (card.getAttribute('data-categoria-id') === selectedCategoria) {
            card.style.display = ''; 
        } else {
            card.style.display = 'none'; 
        }
    });
});
</script>
</body>
</html>
@else
<p>Lo siento, solo los usuarios de tipo 'Cliente' pueden acceder a esta vista.</p>
@endif
