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

$nombre_usuario = $_SESSION['nombre_usuario'];
$tipo = $_SESSION['tipo'] ?? 'NOT';

try {
    //CONEXIÓN A LA BD
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['nombre_usuario']) || $tipo != "Admin"){
        header("Location: index.php");
        exit();
    }    
    header('Content-Type: text/html');
    readfile("gestion.html");
    echo '<script src="generauser.js"></script>';
    echo '<script>ocultaform("' . $nombre_usuario . '", "' . $tipo . '");</script>';
    echo '<script>change_enlaces();</script>'; 
    $consultaSQL = "SELECT * FROM peliculas";
    $resultados = $conexion->query($consultaSQL);
    foreach ( $resultados as $fila ) {
        $titulo=$fila['titulo']; $cat=$fila['categoria']; $port=basename($fila['portada']); $dir=$fila['director'];
        $estre=$fila['estreno']; $img1=basename($fila['img1']); $img2=basename($fila['img2']); $img3=basename($fila['img3']); $img4=basename($fila['img4']);
        $inter=$fila['interpretes']; $sinop=$fila['sinopsis']; $tema=$fila['tematicas']; $info=$fila['informacion']; $val=$fila['valoracion'];$id=$fila['id'];
        echo '<script src="generauser.js"></script>';
        echo '<script>agregargestion("' . $titulo . '","' . $cat . '","' . $port . '","' . $dir . '","' . $estre . '","' . $img1 . '","' . $img2 . '","' . $img3 . '","' . $img4 . '","' . $inter . '","' . $sinop . '","' . $tema . '","' . $info . '","' . $val . '","' . $id . '");</script>';
    }
} catch (PDOException $e) {
    echo "CONSULT ERROR: " . $e->getMessage();
}  
$conexion = null;

?>
