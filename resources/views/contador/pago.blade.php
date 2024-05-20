
@if (Auth::check() && (Auth::user()->role == '' || Auth::user()->role == 'Contador'))
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pagos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
    <a href="/misPagos" class="btn btn-primary">Mi Botón</a>
        <div class="row">
            <div class="col-md-4">
                <!-- Select para filtrar por vendedores -->
                <label for="vendedorSelect">Filtrar por vendedor:</label>
                <select id="vendedorSelect" onchange="filterByVendedor()">
                    <option value="">Todos los vendedores</option>
                    @foreach ($vendedoresDisponibles as $id => $nombre)
                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Agrega la tabla de pagos -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Lista de Pagos</h2>
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Vendedor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productosVendidos as $producto)
                        <tr data-compra-id="{{ $producto['compra_id'] }}" data-producto-id="{{ $producto['producto_id'] }}" data-vendedor-id="{{ $producto['vendedor_id'] }}">
                            <td>{{ $producto['nombre'] }}</td>
                            <td>{{ $producto['cantidad'] }}</td>
                            <td>{{ $producto['nombre_vendedor'] }}</td>
                            <td>
                                @if ($producto['estado_vendedor'] == 'pendiente')
                                    <a href="#" class="btnPagar">Pagar</a>
                                @else
                                    Pagado
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Agrega la tabla de productos a pagar y comisiones -->
            <div class="col-md-6">
                <h2>Productos a Pagar y Comisiones</h2>
                <table class="table" id="comisionesTable">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Vendedor</th>
                            <th>Monto Comisión</th>
                            <th>Fecha Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se mostrarán los productos a pagar y las comisiones -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function filterByVendedor() {
            var select, table, tr, td, i, txtValue, filter;
            select = document.getElementById("vendedorSelect");
            table = document.getElementById("productTable");
            tr = table.getElementsByTagName("tr");
            filter = select.value.toUpperCase();

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1 || filter === "") {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }

        document.querySelectorAll('.btnPagar').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let row = this.closest('tr');
                let compraId = row.dataset.compraId;
                let productoId = row.dataset.productoId;
                let vendedorId = row.dataset.vendedorId;
                let contadorId = "{{ Auth::id() }}"; // ID del contador logueado

                fetch('/procesar-pago', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ compraId, productoId, vendedorId, contadorId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let newRow = `
                            <tr>
                                <td>${data.producto}</td>
                                <td>${data.vendedor_nombre}</td>
                                <td>${data.monto}</td>
                                <td>${data.fecha_pago}</td>
                            </tr>
                        `;
                        document.querySelector('#comisionesTable tbody').insertAdjacentHTML('beforeend', newRow);
                        row.querySelector('td:nth-child(4)').innerText = 'Pagado';
                    } else {
                        alert('Hubo un error al procesar el pago.');
                    }
                });
            });
        });
    </script>
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Contador' pueden acceder a esta vista.</p>
@endif