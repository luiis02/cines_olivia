<?php
define("DB_DSN", "mysql:host=localhost;dbname=dbluisalcalde_pw2223");
define("DB_USUARIO", "pwluisalcalde");
define("DB_PASSWORD", "22luisalcalde23");
session_start();
if (isset($_GET['accion']) && $_GET['accion'] == 'cerrar_sesion') {
    session_destroy();
    header("Location: index.html");
    exit();
}


$nombre_usuario = $_SESSION['nombre_usuario'];
$cadena = $_REQUEST["q"];
try {
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consultaSQL = "SELECT TIPO FROM USERS WHERE USERNAME='$nombre_usuario'";
    $resultados = $conexion->query($consultaSQL);
    $fila = $resultados->fetch();
    $tipo = $fila['TIPO'];
    if (!isset($_SESSION['nombre_usuario']) || $tipo != "Admin"){
        header("Location: index.html");
        exit();
    }    
    $consultaSQL = "DELETE FROM peliculas WHERE id='$cadena'";
    $resultados = $conexion->query($consultaSQL);
} catch (PDOException $e) {
    echo "CONSULT ERROR: " . $e->getMessage();
}
$conexion = null;

?>
