document.querySelectorAll('.button').forEach(button => {
    button.addEventListener('click', e => {
        // Previene el comportamiento predeterminado (enviar el formulario)
        e.preventDefault();

        // Agrega la clase 'delete' cuando se hace clic en el botón
        if(!button.classList.contains('delete')) {
            button.classList.add('delete');

            // Elimina la clase 'delete' y envía el formulario después de que termine la animación
            setTimeout(() => {
                button.classList.remove('delete');
                button.closest('form').submit(); // Encuentra el formulario más cercano y lo envía
            }, 4000); // Aquí se espera 1000000 milisegundos (1000 segundos)
        }
    });
});
