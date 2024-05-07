@if ( is_null(Auth::user()) )
  primero debes iniciar    
@else
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
 <link rel="stylesheet" href="{{asset('css/tabla.css')}}"> <!-- Asegúrate de reemplazar con la ruta correcta a tu archivo CSS -->
</head>
<body>
 <div class="container">
 <ul class="box-info">
        <li>
            <i class='bx bxs-user-check'></i>
            <span class="text">
                <h3>{{ $numeroDeUsuarios }}</h3>
                <p>Usuarios Registrados</p>
            </span>
        </li>
    </ul>
	<table>
		<thead>
			<tr>
				<th>N°</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		    @forelse ($usuarios as $elemento)
		        <tr>
		          <td> {{$loop->iteration}} </td>
		          <td> {{$elemento->nombre}}, {{$elemento->apellido_paterno}} {{$elemento->apellido_materno}}</td>
				  <td> {{$elemento->correo}} </td>
		          <td> {{$elemento->role}} </td>
		          <td> 
		            
				  <button id="editButton" onclick="window.location.href='{{route('editar',$elemento->id)}}'" class="btn btn-editar">Editar</button>

		            <form action="{{route('destruir2',$elemento->id)}}" method="post" style="display: inline;">
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

<button onclick="location.href='{{route('crear')}}'" type="button" class="crear-usuario">
    CREAR USUARIO
</button>




<script src="{{asset('js/tabla.js')}}"></script> 
</body>
</html>    
@endif
