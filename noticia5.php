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
header('Content-Type: text/html');
readfile("noticia5.html");
if (isset($_SESSION['nombre_usuario'])) {
    echo '<script src="generauser.js"></script>';
    echo '<script>ocultaform("' . $nombre_usuario . '", "' . $tipo . '");</script>';    
}
echo '<script src="generauser.js"></script>';
echo '<script>change_enlaces();</script>'; 
?>
