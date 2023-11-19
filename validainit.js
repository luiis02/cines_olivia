document.getElementById('formulariologin').addEventListener('submit', function(event) {
    var username = document.getElementById('usuario');
    var key = document.getElementById('contrasena');
    var warnings = document.getElementById('warnings');

    if (username.value.length < 3 || key.value.length < 3 || username.value === "" || username.value == null || key.value === "" || key.value == null ) {
        event.preventDefault();
        warnings.textContent = 'Completa la solicitud!';
    }
});
