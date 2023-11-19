<?php
define("DB_DSN", "mysql:host=localhost;dbname=dbluisalcalde_pw2223");
define("DB_USUARIO", "pwluisalcalde");
define("DB_PASSWORD", "22luisalcalde23");
session_start();
if (isset($_GET['accion']) && $_GET['accion'] == 'cerrar_sesion') {
    session_destroy();
    header("Location: index.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'] ?? 'NOT';
$tipo = $_SESSION['tipo'] ?? 'NOT';
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    header('Content-Type: text/html');
    readfile("index.html");
    if (isset($_GET['l'])) {
        if(($_GET['l'])=="i"){
        echo '<script src="generauser.js"></script>';
        echo "<script>envia_warnings('USER/PSWD INCORRECTOS');</script>";  
        }
    }
    
    if (isset($_SESSION['nombre_usuario'])) {
        echo '<script src="generauser.js"></script>';
        echo '<script>ocultaform("' . $nombre_usuario . '", "' . $tipo . '");</script>';
    }
    echo '<script src="generauser.js"></script>';
    echo '<script>vaciarLista();</script>';    
    echo '<script>change_enlaces();</script>';

try {
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consultaSQL = "SELECT * FROM peliculas WHERE categoria='estrenos'";
    $resultados = $conexion->query($consultaSQL);
    $contador = 0;
    foreach ( $resultados as $fila ) {
        $contador++;
        if ($contador > 3) {
            break;
        }
        $enlace = "peli" . $fila['id'] . "html";
        echo '<script src="generauser.js"></script>';
        echo '<script>indexEstrenos("pelis-lista","' . $fila['titulo'] . '","' . $enlace . '","' . $fila['portada'] . '","' . $fila['director'] . '","' . $fila['estreno'] . '","' . $fila['interpretes'] . '","' . $fila['valoracion'] . '","' . $fila['id'] . '","' . $fila['categoria'] . '");</script>';         
    }
    $consultaSQL = "SELECT * FROM peliculas WHERE categoria='cartelera'";
    $resultados = $conexion->query($consultaSQL);
    $contador = 0;
    foreach ( $resultados as $fila ) {
        $contador++;
        if ($contador > 3) {
            break;
        }
        $enlace = "peli" . $fila['id'] . "html";
        echo '<script src="generauser.js"></script>';
        echo '<script>indexEstrenos("pelis-lista2","' . $fila['titulo'] . '","' . $enlace . '","' . $fila['portada'] . '","' . $fila['director'] . '","' . $fila['estreno'] . '","' . $fila['interpretes'] . '","' . $fila['valoracion'] . '","' . $fila['id'] . '","' . $fila['categoria'] . '");</script>';         
    }
    $consultaSQL = "SELECT * FROM peliculas WHERE categoria='valoradas'";
    $resultados = $conexion->query($consultaSQL);
    $contador = 0;
    foreach ( $resultados as $fila ) {
        $contador++;
        if ($contador > 3) {
            break;
        }
        $enlace = "peli" . $fila['id'] . "html";
        echo '<script src="generauser.js"></script>';
        echo '<script>indexEstrenos("pelis-lista3","' . $fila['titulo'] . '","' . $enlace . '","' . $fila['portada'] . '","' . $fila['director'] . '","' . $fila['estreno'] . '","' . $fila['interpretes'] . '","' . $fila['valoracion'] . '","' . $fila['id'] . '","' . $fila['categoria'] . '");</script>';         
    }
    $consultaSQL = "SELECT * FROM peliculas WHERE categoria='proximas'";
    $resultados = $conexion->query($consultaSQL);
    $contador = 0;
    foreach ( $resultados as $fila ) {
        $contador++;
        if ($contador > 3) {
            break;
        }
        $enlace = "peli" . $fila['id'] . "html";
        echo '<script src="generauser.js"></script>';
        echo '<script>indexEstrenos("pelis-lista4","' . $fila['titulo'] . '","' . $enlace . '","' . $fila['portada'] . '","' . $fila['director'] . '","' . $fila['estreno'] . '","' . $fila['interpretes'] . '","' . $fila['valoracion'] . '","' . $fila['id'] . '","' . $fila['categoria'] . '");</script>';         
    }
    if(isset($_GET['new'])){
        echo '<script src="generauser.js"></script>';
        echo '<script>envia_alert("Bienvenido a CINES OLIVIA, vuelve a inicar sesion.");</script>';    
    }

} catch (PDOException $e) {
    echo "CONSULT ERROR: " . $e->getMessage();
}
$conexion = null;

?>
