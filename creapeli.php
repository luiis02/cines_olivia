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
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['nombre_usuario']) || $tipo != "Admin") {
        // Si el usuario no ha iniciado sesión o no es un administrador, redirige al archivo index.html.
        header("Location: index.html");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST['titulo'];
        $opcion = $_POST['opcion'];
        $nombre_portada = "imagenes-pelis/" .  $_POST['nombre_portada'];
        $director = $_POST['director'];
        $fecha_estreno = $_POST['fecha_estreno'];
        $nombre_imagen_1 = "imagenes-pelis/" . $_POST['nombre_imagen_1'];
        $nombre_imagen_2 = "imagenes-pelis/" . $_POST['nombre_imagen_2'];
        $nombre_imagen_3 = "imagenes-pelis/" . $_POST['nombre_imagen_3'];
        $nombre_imagen_4 = "imagenes-pelis/" . $_POST['nombre_imagen_4'];
        $interpretes = $_POST['interpretes'];
        $sinopsis = $_POST['sinopsis'];
        $tematicas = $_POST['tematicas'];
        $informacion = $_POST['informacion'];
        $valoracion = $_POST['valoracion'];

        $consultaSQL = "INSERT INTO peliculas(titulo, categoria, portada, director, estreno, img1, img2, img3, img4, interpretes, sinopsis, tematicas, informacion, valoracion)
        VALUES (:titulo, :opcion, :nombre_portada, :director, :fecha_estreno, :nombre_imagen_1, :nombre_imagen_2, :nombre_imagen_3, :nombre_imagen_4, :interpretes, :sinopsis, :tematicas, :informacion, :valoracion)";
        
        

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $sentencia->bindParam(':opcion', $opcion, PDO::PARAM_STR);
        $sentencia->bindParam(':nombre_portada', $nombre_portada, PDO::PARAM_STR);
        $sentencia->bindParam(':director', $director, PDO::PARAM_STR);
        $sentencia->bindParam(':fecha_estreno', $fecha_estreno, PDO::PARAM_STR);
        $sentencia->bindParam(':nombre_imagen_1', $nombre_imagen_1, PDO::PARAM_STR);
        $sentencia->bindParam(':nombre_imagen_2', $nombre_imagen_2, PDO::PARAM_STR);
        $sentencia->bindParam(':nombre_imagen_3', $nombre_imagen_3, PDO::PARAM_STR);
        $sentencia->bindParam(':nombre_imagen_4', $nombre_imagen_4, PDO::PARAM_STR);
        $sentencia->bindParam(':interpretes', $interpretes, PDO::PARAM_STR);
        $sentencia->bindParam(':sinopsis', $sinopsis, PDO::PARAM_STR);
        $sentencia->bindParam(':tematicas', $tematicas, PDO::PARAM_STR);
        $sentencia->bindParam(':informacion', $informacion, PDO::PARAM_STR);
        $sentencia->bindParam(':valoracion', $valoracion, PDO::PARAM_STR);

        $sentencia->execute();
        header("Location: gestion.php");
    }
} catch (PDOException $e) {
    echo "CONSULT ERROR: " . $e->getMessage();
}
$conexion = null;
?>

