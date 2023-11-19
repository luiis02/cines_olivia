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
        // Si el usuario no ha iniciado sesión o no es un administrador, redirige al index.html.
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
        $id = $_POST['id'];
        if($opcion==0){
            $opcion="estrenos";
        }elseif($opcion==1){
            $opcion="cartelera";
        }elseif($opcion==1){
            $opcion="valoradas";
        }elseif($opcion==1){
            $opcion="proximas";
        }

        $consultaSQL = "UPDATE peliculas SET titulo = :titulo, categoria = :opcion, portada = :nombre_portada, director = :director,
        estreno = :fecha_estreno, img1 = :nombre_imagen_1, img2 = :nombre_imagen_2, img3 = :nombre_imagen_3, img4 = :nombre_imagen_4,
        interpretes = :interpretes, sinopsis = :sinopsis, tematicas = :tematicas, informacion = :informacion, valoracion = :valoracion
        WHERE id = :id";
        
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $sentencia->bindValue(':opcion', $opcion, PDO::PARAM_STR);
        $sentencia->bindValue(':nombre_portada', $nombre_portada, PDO::PARAM_STR);
        $sentencia->bindValue(':director', $director, PDO::PARAM_STR);
        $sentencia->bindValue(':fecha_estreno', $fecha_estreno, PDO::PARAM_STR);
        $sentencia->bindValue(':nombre_imagen_1', $nombre_imagen_1, PDO::PARAM_STR);
        $sentencia->bindValue(':nombre_imagen_2', $nombre_imagen_2, PDO::PARAM_STR);
        $sentencia->bindValue(':nombre_imagen_3', $nombre_imagen_3, PDO::PARAM_STR);
        $sentencia->bindValue(':nombre_imagen_4', $nombre_imagen_4, PDO::PARAM_STR);
        $sentencia->bindValue(':interpretes', $interpretes, PDO::PARAM_STR);
        $sentencia->bindValue(':sinopsis', $sinopsis, PDO::PARAM_STR);
        $sentencia->bindValue(':tematicas', $tematicas, PDO::PARAM_STR);
        $sentencia->bindValue(':informacion', $informacion, PDO::PARAM_STR);
        $sentencia->bindValue(':valoracion', $valoracion, PDO::PARAM_STR);
        $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
        
        
        $sentencia->execute();
        
        header("Location: gestion.php");
        exit();
    }
} catch (PDOException $e) {
    echo "CONSULT ERROR: " . $e->getMessage();
}
$conexion = null;
?>


