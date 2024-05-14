@if (Auth::check() && (Auth::user()->role == 'Encargado' || Auth::user()->role == 'Vendedor'))
    <!-- Aquí va el código de tu vista para los usuarios de tipo 'Encargado' o 'Cliente' -->



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas y Respuestas</title>
    <style>
        /* Añade aquí tus estilos CSS */
    </style>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>Pregunta</th>
            <th>Respuesta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($preguntas as $pregunta)
            <tr>
                <td>{{ $pregunta->contenido }}</td>
                <td>{{ $pregunta->respuesta }}</td>
                <td>
                    <form action="/respuesta/{{ $pregunta->id }}" method="POST">
                    @csrf
                        <input type="text" name="respuesta" placeholder="Escribe tu respuesta aquí...">
                        <button type="submit">Responder</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    <script>
    window.onload = function() {
        // Obtén los elementos necesarios
        var userList = document.querySelector('#users');
        var questionList = document.querySelector('#questions');
        var responseForm = document.querySelector('#response-form');

        // Haz una solicitud GET a la ruta /usuarios
        fetch('/usuarios')
            .then(response => response.json())
            .then(usuarios => {
                // Por cada usuario, crea un elemento li y añade el nombre del usuario
                usuarios.forEach(usuario => {
                    var userLi = document.createElement('li');
                    userLi.textContent = usuario.nombre;
                    userLi.addEventListener('click', function() {
                        // Cuando haces clic en un usuario, muestra sus preguntas
                        mostrarPreguntas(usuario.id);
                    });
                    userList.appendChild(userLi);
                });
            });

        function mostrarPreguntas(usuarioId) {
            // Haz una solicitud GET a la ruta /preguntas/usuarioId
            fetch('/preguntas/' + usuarioId)
                .then(response => response.json())
                .then(preguntas => {
                    // Limpia las preguntas antiguas
                    questionList.innerHTML = '';

                    // Por cada pregunta, crea un elemento div y añade la pregunta y la respuesta
                    preguntas.forEach(pregunta => {
                        var preguntaDiv = document.createElement('div');
                        preguntaDiv.innerHTML = `
                            <h4>Pregunta: ${pregunta.contenido}</h4>
                            <p>Respuesta: ${pregunta.respuesta || 'Aún no respondida'}</p>
                        `;
                        questionList.appendChild(preguntaDiv);

                        // Configura el formulario de respuesta para responder a esta pregunta
                        responseForm.querySelector('#id_pregunta').value = pregunta.id;
                    });
                });
        }
    };
    </script>
</body>
</html>
@else
    <p>Lo siento, solo los usuarios de tipo 'Encargado' o 'Vendedor' pueden acceder a esta vista.</p>
@endif