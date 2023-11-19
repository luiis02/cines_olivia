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

try {
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    header('Content-Type: text/html');
    readfile("estrenos.html");
    if (isset($_SESSION['nombre_usuario'])) {
    echo '<script src="generauser.js"></script>';
    echo '<script>ocultaform("' . $nombre_usuario . '", "' . $tipo . '");</script>';    
    }
    echo '<script src="generauser.js"></script>';
    echo '<script>vaciacartelera();</script>'; 
    echo '<script>change_enlaces();</script>'; 
    $consultaSQL = "SELECT * FROM peliculas WHERE categoria='estrenos'";
    $resultados = $conexion->query($consultaSQL);
    foreach ( $resultados as $fila ) {
        $enlace = "peli.php?q=" . $fila['id'] ;
        echo '<script src="generauser.js"></script>';
        echo '<script>agregarPelicula("estrenos-forma","' . $fila['titulo'] . '","' . $enlace . '","' . $fila['portada'] . '");</script>';    
    } 
} catch (PDOException $e) {
    echo "CONSULT ERROR: " . $e->getMessage();
}
$conexion = null;

?>
