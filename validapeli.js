const formulario = document.getElementById("formpeliinsert");
const enviarBtn = document.getElementById("enviar");

function validarFormulario(event) {
  event.preventDefault();

  const titulo = formulario.elements["titulo"].value;
  const opcion = formulario.elements["opcion"].value;
  const portada = formulario.elements["nombre_portada"].value;
  const director = formulario.elements["director"].value;
  const estreno = document.getElementById("fecha_estreno").value;
  const img1 = formulario.elements["nombre_imagen_1"].value;
  const img2 = formulario.elements["nombre_imagen_2"].value;
  const img3 = formulario.elements["nombre_imagen_3"].value;
  const img4 = formulario.elements["nombre_imagen_4"].value;
  const interpretes = formulario.elements["interpretes"].value;
  const sinopsis = formulario.elements["sinopsis"].value;
  const tematicas = formulario.elements["tematicas"].value;
  const informacion = formulario.elements["informacion"].value;
  const valoracion = document.getElementById("valoracion").value;

  if (
    titulo === "" ||
    opcion === "" ||
    portada === "" ||
    director === "" ||
    estreno === "" ||
    img1 === "" ||
    img2 === "" ||
    img3 === "" ||
    img4 === "" ||
    interpretes === "" ||
    sinopsis === "" ||
    tematicas === "" ||
    informacion === "" ||
    valoracion === ""
  ) {
    alert("Por favor, rellene todos los campos.");
  } else if(valoracion>5 || valoracion<0){
    alert("Por favor, introduce una valoración entre 0 y 5.");
  } else {
    formulario.submit();
  }
}


enviarBtn.addEventListener("click", validarFormulario);
