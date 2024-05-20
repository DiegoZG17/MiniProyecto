@if (Auth::check() && (Auth::user()->role == 'Encargado' || Auth::user()->role == 'Supervisor'|| Auth::user()->role == 'Vendedor'))
    <!-- Aquí va el código de tu vista para los usuarios de tipo 'Encargado' o 'Cliente' -->


<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=2.0">
 <title>Document</title>
 <link rel="stylesheet" href="{{asset('css/tabla.css')}}">
 
</head>
<body>
<div style="text-align: center; margin-top: 20px;">
    <button onclick="location.href='{{route('crearpro')}}'" type="button" class="crear-producto">
        CREAR PRODUCTO
    </button>

    
    @if ($usuarioActual->role == 'Supervisor')
    <button onclick="location.href='{{route('historialuse')}}'" type="button" class="ver-historial">
        VER HISTORIAL
    </button>
@endif
</div>
  
 <div class="container">
 <ul class="box-info">
    
    <li>
        <i class='bx bxs-box'></i>
        <span class="text">
            <h3>{{ $numeroDeProductosPropuestos }}</h3>
            <p>Productos Propuestos</p>
        </span>
    </li>
    <br>
    <li>
        <i class='bx bxs-box'></i>
        <span class="text">
            <h3>{{ $numeroDeProductosConsignados }}</h3>
            <p>Productos Consignados</p>
        </span>
    </li>
</ul>
<br>

    <input type="text" id="search" onkeyup="search()" placeholder="Buscar por categoría...">
	
	<table id="productTable">
   
		<thead>
            
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Estado</th>
				<th>Fecha de Publicación</th>
				<th>Motivo</th>
				<th>Descripción</th>
				<th>Cantidad</th>
                <th>Foto</th>
				<th>Precio</th>
				<th>Categoría</th>
				<th>Propietario</th>
				<th>Fecha de Creación</th>
				<th>Fecha de Actualización</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		    @forelse ($productos as $producto)
		        <tr>
		          <td> {{$producto->id}} </td>
		          <td> {{$producto->nombre}} </td>
		          <td> {{$producto->estado}} </td>
		          <td> {{$producto->fecha_publicacion}} </td>
		          <td> {{$producto->motivo}} </td>
		          <td> {{$producto->descripcion}} </td>
		          <td> {{$producto->cantidad}} </td>
                  <td> {{$producto->fotos}} </td>
				  <td> {{$producto->precio}} </td>
		          <td> {{$producto->categoria ? $producto->categoria->nombre : 'N/A'}} </td>
      <td> {{$producto->propietario ? $producto->propietario->nombre : 'N/A'}} </td>
		          <td> {{$producto->created_at}} </td>
		          <td> {{$producto->updated_at}} </td>
		          <td> 
                  <button id="editButton" onclick="window.location.href='{{route('editarProducto',$producto->id)}}'" class="btn btn-editar">Editar</button>
                  
                  
<form action="{{route('destruir',$producto->id)}}" method="post" style="display: inline;">
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
<br>

@if ($usuarioActual->role == 'Supervisor')
    <button onclick="location.href='{{ route('kardex.ver', ['id' => $producto->id]) }}'" type="button" class="ver-historial">
        VER KARDEX
    </button>
@endif
</form>

		          </td>
		        </tr>
		    @empty
		        
		    @endforelse
		</tbody>
	</table>
</div>
<br><br>


<br><br>




<script src="{{asset('js/tabla.js')}}"></script> 

<script>
function search() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("productTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[9];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Encargado' , 'Supervisor' y Vendedor pueden acceder a esta vista.</p>
@endif