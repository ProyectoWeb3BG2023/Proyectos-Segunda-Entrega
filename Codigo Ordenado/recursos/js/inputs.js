
// Obtenemos una referencia al botón y a todos los inputs
const botonCambiarEstado = document.getElementById('editar');
const inputs = document.querySelectorAll('.dato');

const tarjetas = document.querySelectorAll('contenedorTarjetas');

// Agregamos un evento al botón para cambiar el estado de todos los inputs
botonCambiarEstado.addEventListener('click', function() {
    inputs.forEach(function(input) {
        if (input.readOnly) {
            input.readOnly = false; // Cambiar a editable
            
        } else {
            input.readOnly = true; // Cambiar a solo lectura
        }
    });

});

