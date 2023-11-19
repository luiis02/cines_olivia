document.querySelector('.formulario-contacto').addEventListener('submit', function(event) {
    var valoracion = document.getElementById('valoracion-msj');
    var comentario = document.getElementById('comentarios-mensj');
    var warnings = document.getElementById('warnings');

    valoracion = parseFloat(valoracion.value);
    comentario = comentario.value.trim();

    if (valoracion < 0 || valoracion > 5 || isNaN(valoracion)) {
        event.preventDefault();
        warnings.textContent = 'La valoración debe estar entre 0 y 5';
    }

    if (comentario.length < 4 || comentario.length > 200) {
        event.preventDefault();
        warnings.textContent = 'El comentario debe tener entre 4 y 200 caracteres';
    }
});
