const botonCambiarEstado = document.getElementById('editar');
const inputs = document.querySelectorAll('.dato');
const tarjetas = document.querySelectorAll('.contenedorTarjetas');
const tarjetawer = document.querySelectorAll('.tarjeta');

botonCambiarEstado.addEventListener('click', function() {
    inputs.forEach(function(input) {
        if (input.readOnly) {
            input.readOnly = false; // Cambiar a editable
        } else {
            input.readOnly = true; // Cambiar a solo lectura
        }
    });

    inputs.forEach(function(tar) {
        if (tar.classList.contains('tarjetaEditable')) {
            tar.classList.remove('tarjetaEditable');
        } else {
            tar.classList.add('tarjetaEditable');
        }
    });
});
