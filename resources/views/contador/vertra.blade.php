@if (Auth::check() && (Auth::user()->role == '' || Auth::user()->role == 'Contador'))
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
 <link rel="stylesheet" href="{{asset('css/tabla.css')}}">
</head>
<body>
  
 <div class="container">
    
	
	<table id="productTable">
   
		<thead>
			<tr>
				<th>ID</th>
				<th>Usuario ID</th>
				<th>Total</th>
				<th>Productos</th>
				<th>Estado</th>
				<th>Fecha de Creación</th>
				<th>Fecha de Actualización</th>
				<th>Pago</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		    @forelse ($compras as $compra)
		        <tr>
		          <td> {{$compra->id}} </td>
		          <td> {{$compra->usuario_id}} </td>
		          <td> {{$compra->total}} </td>
                  <td> 
		          @foreach(json_decode($compra->productos, true) as $producto)
		            {{$producto['nombre']}}
		          @endforeach
		          </td>
		          <td> {{$compra->estado}} </td>
		          <td> {{$compra->created_at}} </td>
		          <td> {{$compra->updated_at}} </td>
		          <td> {{$compra->pago}} </td>
		          <td> 
                  <button id="editButton" onclick="window.location.href='{{route('transacciones.formu', ['id' => $compra->id])}}'" class="btn btn-editar">Editar</button>

<br>
<br>

<a id="viewPaymentButton" href="{{ asset('vouchers/' . $compra->pago) }}" class="btn btn-ver-pago" target="_blank">Ver pago</a>

                  


		          </td>
		        </tr>
		    @empty
		        
		    @endforelse
		</tbody>
	</table>
</div>
<br><br><br>


@else
    <p>Lo siento, solo los usuarios de tipo 'Contador' pueden acceder a esta vista.</p>
@endif