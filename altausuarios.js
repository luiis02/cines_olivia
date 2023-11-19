const form = document.getElementById("registrousers");
const username = document.getElementById("user");
const nombre = document.getElementById("nombre");
const apellido = document.getElementById("apellido");
const telefono = document.getElementById("telefono");
const correo = document.getElementById("correo");
const contraseña1 = document.getElementById("contraseña");
const contraseña2 = document.getElementsByName("contraseña")[1];
const warnings = document.getElementById("warnings2");

form.addEventListener("submit", function (event) {
    event.preventDefault();
    let messages = [];

    if (username.value === "" || username.value == null || username.value.length <= 3 || username.value.length > 10) {
        if (username.value.length <= 3 && username.value !== "") {
            messages.push("⚠ El nombre de usuario es demasiado corto.");
        }
        else if (username.value.length > 10){
            messages.push("⚠ Username max 10 caracteres.");
        }
        else {
            messages.push("⚠ El nombre de usuario es obligatorio.");
        }
    }


    if (nombre.value === "" || nombre.value == null || nombre.value.length < 3 || nombre.value.length > 10) {
        if (nombre.value.length < 3 && nombre.value !== "") {
            messages.push("⚠ El nombre  es demasiado corto.");
        }
        else if(nombre.value.length > 10){
            messages.push("⚠ Nombre max 10 caracteres.");
        }else{
            messages.push("⚠ El nombre es obligatorio.");
        }
    }


    if (apellido.value === "" || apellido.value == null || apellido.value.length < 3 || apellido.value.length > 10) {
        if (apellido.value.length < 3 && apellido.value !== "") {
            messages.push("⚠ El apellido  es demasiado corto.");
        }else if(apellido.value.length > 10){
            messages.push("⚠ Apellido max 10 caracteres.");

        } else {
            messages.push("⚠ El apellido es obligatorio.");
        }
    }
    if (correo.value === "" || correo.value == null || validateEmail(correo.value) === false || correo.value.length > 32) {
        if (correo.value === "" || correo.value == null){
            messages.push("⚠ El correo es obligatorio.");
        }else if (correo.value.length > 32){
            messages.push("⚠ Correo max 32 caracteres.");
        }else{
            messages.push("⚠ El correo es invalido.");
        }
    }
    if (telefono.value != null && telefono.value != "") {
        if (telefono.value.length !== 9 || validarCadenaNumerica(telefono.value)=== false){
            messages.push("⚠ El teléfono debe ser de 9 cifras.");
        }
    }
    

    if (contraseña1.value === "" || contraseña1.value == null || contraseña1.value.length < 8 || validarCadena(contraseña1.value) === false){
        if(contraseña1.value.length<8 && contraseña1.value !== ""){
            messages.push("⚠ Contraseña de minimo 8 caracteres")
        }else if (contraseña1.value === ""){
            messages.push("⚠ La contraseña es obligatoria.");
        }else{
            messages.push("⚠ Contraseña con al menos una mayuscula y un numero")
        }
    }

    if (contraseña2.value !== contraseña1.value){
        messages.push("⚠ La contraseñas no coinciden")
    }
    if (messages.length > 0) {
        warnings.innerText = messages.join("\n");
    } else {
        form.submit();
    }
});

function validarCadenaNumerica(cadena) {
    var numeros = /^\d+$/; // Expresión regular para comprobar si la cadena solo contiene números
    if (!numeros.test(cadena)) {
      return false;
    }
    return true;
}
  
function validarCadena(cadena) {
    // Comprobar si hay un número
    var numero = /[0-9]/;
    if (!numero.test(cadena)) {
        return false;
    }

    // Comprobar si hay una mayúscula
    var mayuscula = /[A-Z]/;
    if (!mayuscula.test(cadena)) {
        return false;
    }

    // Si se ha llegado hasta aquí, la cadena es válida
    return true;
}
function validateEmail (valor){
	re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
	if(!re.exec(valor)){
        return false;
    }
	else return true;
} 