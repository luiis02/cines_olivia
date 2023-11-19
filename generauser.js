function envia_alert(mensaje) {
  alert(mensaje);
}
function envia_warnings(mensaje) {
  var tdElement = document.querySelector("#warnings");
  tdElement.innerHTML = mensaje;
}
function ocultaform(nombre, tipo) {
  const form = document.getElementById("formulariologin");
  const h1 = document.createElement("h1");
  h1.innerHTML =
    "<br><br>Bienvenido <a id='tipeuserreg' href='change.php'>" +
    nombre +
    "</a><br>Tipo de cuenta: " +
    tipo +
    "<br><a id='cerrsesi' href='index.php?accion=cerrar_sesion'>Cerrar sesión</a><br><br><br>";
  form.innerHTML = "";
  form.appendChild(h1);

  if (tipo === "Admin") {
    const abajoSection = document.querySelector('.abajo');
    if (abajoSection !== null) {
      const ul = abajoSection.querySelector('ul');
      const li = document.createElement('li');
      const a = document.createElement('a');
      a.classList.add('bmenu');
      a.href = 'gestion.php';
      a.textContent = 'Gestión';
  
      li.appendChild(a);
      ul.appendChild(li);
    }
  }
}

function generainfo(user, nombre, apellido, telefono, correo) {
  var tdElement = document.querySelector("#user_");
  tdElement.innerHTML = user;

  tdElement = document.querySelector("#name_");
  tdElement.innerHTML = nombre;

  tdElement = document.querySelector("#subname_");
  tdElement.innerHTML = apellido;

  tdElement = document.querySelector("#telefono_");
  tdElement.innerHTML = telefono;

  tdElement = document.querySelector("#email_");
  tdElement.innerHTML = correo;
}
function vaciacartelera(){
  const estrenosForma = document.querySelector('.estrenos-forma');
  estrenosForma.innerHTML = '';
}
function vaciarLista() {
  var listasPeliculas = document.querySelector(".pelis-lista");
  listasPeliculas.innerHTML="";
  listasPeliculas = document.querySelector(".pelis-lista2");
  listasPeliculas.innerHTML="";
  listasPeliculas = document.querySelector(".pelis-lista3");
  listasPeliculas.innerHTML="";
  listasPeliculas = document.querySelector(".pelis-lista4");
  listasPeliculas.innerHTML="";
}

function agregarPelicula(claseSeccion,titulo,enlace,portada) {
  var seccion = document.querySelector("." + claseSeccion); // Obtener la sección por su clase
  var html = '<a class="enlacepeli" href="EDITA-ENLACE"> \
                <figure id="pelicula-estrenos"> \
                  <img id="img-pelicula" src="EDITA-PORTADA"> \
                  <figcaption id="titulopeli">EDITA-TITULO</figcaption> \
                </figure> \
              </a>';
  html = html.replace("EDITA-ENLACE",enlace);
  html = html.replace("EDITA-PORTADA",portada);
  html = html.replace("EDITA-TITULO",titulo);
  seccion.insertAdjacentHTML("beforeend", html); // Añadir el HTML al final de la sección
}
function indexEstrenos(id, titulo, enlace, portada, director, estreno, Interpretes, Valoracion, uri,cat) {
  var lista = document.getElementsByClassName(id)[0];
  var li = document.createElement("li");
  var html = '<a class="enlacepeli" href="EDITA-ENLACE"> \
                      <figure id="pelicula"> \
                          <img id="img-pelicula" src="EDITA-PORTADA" onmouseover="mostrarVentanaEmergente(\' EDITA-TIT \',\' EDITA-CAT \')"> \
                          <figcaption id="titulopeli">EDITA-TITULO</figcaption> \
                          <ul id="descpeli"> \
                              <li>Director: EDITA-DIRECTOR</li> \
                              <li>Fecha de estreno: EDITA-FECHA-ESTRENO</li> \
                              <li>Interpretes: EDITA-INTERPRETES</li> \
                              <li>Valoración: EDITA-VALORACION</li> \
                          </ul> \
                          <img id="palomitas" src="imagenes/palomitas.png" alt=""> \
                      </figure> \
                  </a>';
  uri = 'peli.php?q=' + uri;
  html = html.replace("EDITA-TIT",titulo)
  html = html.replace("EDITA-CAT",cat)
  html = html.replace("EDITA-ENLACE", uri);
  html = html.replace("EDITA-PORTADA", portada);
  html = html.replace("EDITA-TITULO", titulo);
  html = html.replace("EDITA-DIRECTOR", director);
  html = html.replace("EDITA-FECHA-ESTRENO", estreno);
  html = html.replace("EDITA-INTERPRETES", Interpretes);
  html = html.replace("EDITA-VALORACION", Valoracion);
  li.innerHTML = html;
  lista.appendChild(li);
}

function desplegable(numeroFilas){
  const ventanaEmergente = document.getElementById("ventana-emergente");
  ventanaEmergente.style.display = "block";
  const filaDeseada = document.getElementsByTagName('tr')[numeroFilas]; 
  const columnasFila = filaDeseada.getElementsByTagName('td');
  const datosFila = [];
  console.log(columnasFila[14]);
    
  for (let i = 0; i < columnasFila.length-1; i++) { 
      datosFila.push(columnasFila[i].textContent); 
  }
  var change = document.querySelector('.titulo'); 
  change.value = datosFila[0];
  const opciones = document.querySelector('#opciones');
  if(datosFila[1]==="estrenos") opciones.selectedIndex = 0; 
  if(datosFila[1]==="cartelera") opciones.selectedIndex = 1; 
  if(datosFila[1]==="paloradas") opciones.selectedIndex = 2; 
  if(datosFila[1]==="proximas") opciones.selectedIndex = 3;
  change = document.querySelector('.portada'); 
  change.value = datosFila[2];
  change = document.querySelector('.director'); 
  change.value = datosFila[3];
  change = document.querySelector('.estreno'); 
  change.value = datosFila[4];
  change = document.querySelector('.img1'); 
  change.value = datosFila[5];
  change = document.querySelector('.img2'); 
  change.value = datosFila[6];
  change = document.querySelector('.img3'); 
  change.value = datosFila[7];
  change = document.querySelector('.img4'); 
  change.value = datosFila[8];
  change = document.querySelector('.interpretes'); 
  change.value = datosFila[9];
  change = document.querySelector('.sinopsis'); 
  change.value = datosFila[10];
  change = document.querySelector('.tematicas'); 
  change.value = datosFila[11];
  change = document.querySelector('.informacion'); 
  change.value = datosFila[12];
  change = document.querySelector('.valoracion'); 
  change.value = datosFila[13];  
  change = document.querySelector('.id'); 
  change.value = datosFila[14];  
}
function cerrardesplegable(){
  const ventanaEmergente = document.getElementById("ventana-emergente");
  ventanaEmergente.style.display = "none";
}
function agregargestion(TITULO,CAT,PORTADA,Director,estreno,URL1,URL2,URL3,URL4,INTERPRETES,Sinopsis,TEMAT,INFO,VAL,ID) {
  const tabla = document.getElementById('admin-panel');
  const numeroFilas = tabla.rows.length;
  var seccion = document.querySelector("." + "tbodygest"); // Obtener la sección por su clase
  var html = `<tr>
    <td>${TITULO}</td>
    <td>${CAT}</td>
    <td>${PORTADA}</td>
    <td>${Director}</td>
    <td>${estreno}</td>
    <td>${URL1}</td>
    <td>${URL2}</td>
    <td>${URL3}</td>
    <td>${URL4}</td>
    <td>${INTERPRETES}</td>
    <td>${Sinopsis}</td>
    <td>${TEMAT}</td>
    <td>${INFO}</td>
    <td>${VAL}</td>
    <td>${ID}</td>    
    <td><a href="#" class="editar" id="editar" onclick="desplegable(${numeroFilas})">Editar</a>
    <a href="#" class="elim" id="elim}" onclick="eliminar(${numeroFilas})">Eliminar</a></td>
    </tr>`; 
  seccion.insertAdjacentHTML("beforeend", html); // Añadir el HTML al final de la sección
  }
  
function eliminar(numeroFilas) {
    const filaDeseada = document.getElementsByTagName('tr')[numeroFilas]; 
    const columnasFila = filaDeseada.getElementsByTagName('td');
    const datosFila = [];
    
    for (let i = 0; i < columnasFila.length-1; i++) { 
        datosFila.push(columnasFila[i].textContent); 
    }
    var str=datosFila[14];
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
    }
    
    xmlhttp.open("GET", "elimina.php?q="+str);
    xmlhttp.send();
    location.reload();
  }

function generapeli(titulo, dir, inter, sinop, tema, info, val, img1, img2, img3, img4){
    var imagen = document.querySelector('.p-fotoindiv4');
    imagen.src=img4;
    imagen = document.querySelector('.p-fotoindiv3');
    imagen.src=img3;
    imagen = document.querySelector('.p-fotoindiv2');
    imagen.src=img2;
    imagen = document.querySelector('.p-fotoindiv1');
    imagen.src=img1;
    var peliT = document.getElementsByClassName('peli-titulo')[0]; 
    peliT.textContent = titulo; 
    peliT = document.getElementById('p-titulo');
    peliT.textContent = titulo; 
    peliT = document.getElementsByClassName('peli-dir')[0]; 
    peliT.textContent = dir; 
    peliT = document.getElementsByClassName('peli-int')[0]; 
    peliT.textContent = inter; 
    peliT = document.getElementsByClassName('peli-sinop')[0]; 
    peliT.textContent = sinop; 
    peliT = document.getElementsByClassName('peli-temat')[0]; 
    peliT.textContent = tema; 
    peliT = document.getElementsByClassName('peli-info')[0]; 
    peliT.textContent = info; 
    let estrellas = '';
    for (let i = 1; i <= val; i++) {
      estrellas += '&#9733;';
    }
    estrellas += ` (${val})`;
    val = `<span class="star">${estrellas}</span>`;
    peliT = document.getElementsByClassName('peli-val')[0]; 
    peliT.innerHTML = val; 
  }

function change_enlaces(){
    var links = document.querySelectorAll('a[href="cartelera.html"]');
    links.forEach((link) => {
      link.href = "cartelera.php";
    });
    links = document.querySelectorAll('a[href="estrenos.html"]');
    links.forEach((link) => {
      link.href = "estrenos.php";
    });
    links = document.querySelectorAll('a[href="index.html"]');
    links.forEach((link) => {
      link.href = "index.php";
    });
    links = document.querySelectorAll('a[href="masvaloradas.html"]');
    links.forEach((link) => {
      link.href = "masvaloradas.php";
    });
    links = document.querySelectorAll('a[href="proximas.html"]');
    links.forEach((link) => {
      link.href = "proximas.php";
    });
    links = document.querySelectorAll('a[href="horarios.html"]');
    links.forEach((link) => {
      link.href = "horarios.php";
    });
    links = document.querySelectorAll('a[href="tarifas.html"]');
    links.forEach((link) => {
      link.href = "tarifas.php";
    });
  }

  function vaciarComents(){
    var bloque = document.getElementById("bloque"); 
    var ul = bloque.querySelector("ul");
    while (ul.firstChild) {
      ul.removeChild(ul.firstChild); 
    }    
  }

  function aniadirComents(frase) {
    var bloque = document.getElementById("bloque");
    var ul = bloque.querySelector("ul"); 
    var comentario = document.createElement("li");
    comentario.textContent = frase;
    ul.appendChild(comentario);
  }

  function nocoments(){
    var formulario = document.querySelector('.formulario-contacto');
    formulario.style.display = 'none';    
    formulario = document.getElementById('peli-p');
    formulario.textContent="Registrate o inicia sesion para hacer comentarios!";
    formulario.style.color = 'red';
    
  }


  function mostrarVentanaEmergente(tit, cat) {
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];
    var h3tit = modal.querySelector("h3");
    var h4cat = modal.querySelector("h4");

    h3tit.textContent = tit;
    h4cat.textContent = cat;
    modal.style.display = "block";
    span.onclick = function() {
      modal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }