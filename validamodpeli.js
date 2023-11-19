document.getElementById("formnuevo").addEventListener("submit", function(event) {
    console.log(123);
    
    var titulo = document.getElementById("titulin").value;
    var valoracion = document.getElementById("valora").value;

    if (titulo.trim() === "" || valoracion.trim() === "") {
      event.preventDefault();
      alert("Por favor, completa los campos de Título y Valoración al menos");
    }
  });
