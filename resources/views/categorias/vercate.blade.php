@if (Auth::check() && (Auth::user()->role == 'Encargado' || Auth::user()->role == 'Supervisor'))
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
 <link rel="stylesheet" href="{{asset('css/tabla.css')}}"> <!-- Asegúrate de reemplazar con la ruta correcta a tu archivo CSS -->
</head>
<body>
@if ( is_null(Auth::user()) )
  primero debes iniciar    
@else
 <div class="container">
	<table>
		<thead>
			<tr>
				<th>N°</th>
				<th>Nombre</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		    @forelse ($categorias as $elemento)
		        <tr>
		          <td> {{$loop->iteration}} </td>
		          <td> {{$elemento->nombre}} </td>
		          <td> 
		            <<button onclick="location.href='{{route('categorias.edit',$elemento->id)}}'" type="button">
    Editar
</button>

		            <form action="{{route('categorias.destroy',$elemento->id)}}" method="post" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="button">
        <div class="trash">
            <div class="top">
                <div class="paper"></div>
            </div>
            <div class="box"></div>
            <div class="check">
                <svg viewBox="0 0 8 6">
                    <polyline points="1 3.4 2.71428571 5 7 1"></polyline>
                </svg>
            </div>
        </div>
        <span>Eliminar</span>
    </button>
</form>

		          </td>
		        </tr>
		    @empty
		        
		    @endforelse
		</tbody>
    
	</table>
</div>
<br><br><br>

<button onclick="location.href='{{route('categorias.create')}}'" type="button" class="crear-categoria">
    CREAR CATEGORIA
</button>

@endif

<script src="{{asset('js/tabla.js')}}"></script> 
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Encargado' o 'Supervisor' pueden acceder a esta vista.</p>
@endif