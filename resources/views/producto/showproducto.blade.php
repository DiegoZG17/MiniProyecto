@if (Auth::check() && Auth::user()->role == 'Cliente')
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<title>Pagina Producto</title>
		<link rel="stylesheet" href="{{asset('css/showproducto.css')}}" />
	</head>
	<body>
		

		<main>
		<div class="container-img">
        <img src="{{ asset($ruta_imagen) }}" alt="imagen-producto" />
    </div>
			<div class="container-info-product">
				<div class="container-price">
					<span id="product-price">${{ $producto->precio }}</span>
					<i class="fa-solid fa-angle-right"></i>
				</div>

				<div class="container-details-product">
					<h1 id="product-name">{{ $producto->nombre }}</h1>
					
					
					
				</div>

				<div class="container-add-cart">
					<div class="container-quantity">
						
						<div class="btn-increment-decrement">
							<i class="fa-solid fa-chevron-up" id="increment"></i>
							<i class="fa-solid fa-chevron-down" id="decrement"></i>
						</div>
					</div>
					<form method="POST" action="{{ route('carrito.add', $producto->id) }}">
    @csrf
    <input type="number" name="cantidad" value="1" min="1" max="{{$producto->cantidad}}">
    <button type="submit">Añadir al Carrito</button>
</form>

					<p>Cantidad en stock: {{$producto->cantidad}}</p> 
				</div>

				<div class="container-description">
					<div class="title-description">
						<h4>Descripción</h4>
						<i class="fa-solid fa-chevron-down"></i>
					</div>
					<div class="text-description">
                    <p id="product-description">{{ $producto->descripcion }}</p>
					</div>
				</div>

				<div class="container-additional-information">
					<div class="title-additional-information">
						<h4>Información adicional</h4>
						<i class="fa-solid fa-chevron-down"></i>
					</div>
					<div class="text-additional-information hidden">
						<p>-----------</p>
					</div>
				</div>

				<div id="reviews" class="container-reviews">
					<div class="title-reviews">
						<h4>Reseñas</h4>
						<i class="fa-solid fa-chevron-down"></i>
					</div>
					<div class="text-reviews hidden">
						<!-- Aquí irían las reseñas del producto -->
					</div>
				</div>

				<div class="container-social">
					<span>Compartir</span>
					<div class="container-buttons-social">
						<a href="#"><i class="fa-solid fa-envelope"></i></a>
						<a href="#"><i class="fa-brands fa-facebook"></i></a>
						<a href="#"><i class="fa-brands fa-twitter"></i></a>
						<a href="#"><i class="fa-brands fa-instagram"></i></a>
						<a href="#"><i class="fa-brands fa-pinterest"></i></a>
					</div>
				</div>
                
                <div class="container-additional-information">
				<div class="question-form">
					<h3>Enviar Pregunta</h3>
					<form id="question-form" action="/pregunta" method="POST">
						@csrf
						<input type="hidden" name="producto_id" value="{{ $producto->id }}">
						<input type="text" name="question" placeholder="Escribe tu pregunta aquí...">
						<button type="submit">Enviar Pregunta</button>
					</form>
				</div>

<div class="question-list">
    <h3>Preguntas y Respuestas</h3>
    @foreach ($preguntas as $pregunta)
        <p>{{ $pregunta->contenido }}</p>
        <p>Respuesta: {{ $pregunta->respuesta }}</p>
    @endforeach
</div>

			</div>
			
		</main>
		

		<footer>
			<p></p>
		</footer>

		<script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>


		
		<script src="{{asset('js/showproducto.js')}}">
	document.addEventListener('DOMContentLoaded', function() {
				const form = document.querySelector('#question-form');

				form.addEventListener('submit', function(event) {
					event.preventDefault();

					const formData = new FormData(this);
					const url = this.action;

					fetch(url, {
						method: 'POST',
						body: formData,
						headers: {
							'X-Requested-With': 'XMLHttpRequest',
						},
					})
					.then(response => response.json())
					.then(data => {
						// Aquí puedes actualizar la lista de preguntas y respuestas
						// Por ejemplo, podrías agregar la nueva pregunta a '.question-list'
					})
					.catch(error => {
						console.error('Error:', error);
					});
				});
			});
		</script>
	</body>
	
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Cliente' pueden acceder a esta vista.</p>
@endif