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
    if (isset($_GET['q'])) {
        $id=$_GET['q'];
        header('Content-Type: text/html');
        readfile("pelimodelo.html");
        if ($nombre_usuario == 'NOT'){ 
            echo '<script src="generauser.js"></script>';
            echo '<script>nocoments();</script>'; 
        }

        if (isset($_SESSION['nombre_usuario'])){
            echo '<script src="generauser.js"></script>';
            echo '<script>ocultaform("' . $nombre_usuario . '", "' . $tipo . '");</script>';    
        }
        $consultaSQL = "select * from peliculas where id=?";
        $statement = $conexion->prepare($consultaSQL);
        $statement->execute([$_GET['q']]);
        $fila = $statement->fetch();
        echo '<script src="generauser.js"></script>';
        $urlActual = $_SERVER['REQUEST_URI'];
        $posicion = strpos($urlActual, '=');    
        if ($posicion !== false) {
            $uri = substr($urlActual, $posicion + 1);
        } 
        echo '<script>change_enlaces();</script>'; 
        echo '<script> generapeli("' . $fila['titulo'] . '", "' . $fila['director'] . '", "' . $fila['interpretes'] . '", "' . $fila['sinopsis'] . '", "' . $fila['tematicas'] . '", "' . $fila['informacion'] . '", "' . $fila['valoracion'] . '", "' . $fila['img1'] . '", "' . $fila['img2'] . '", "' . $fila['img3'] . '", "' . $fila['img4'] . '");</script>';
        echo '<script>vaciarComents()</script>';
        $consultaSQL = "select * from comentarios where idpeli=$uri";
        $resultados = $conexion->query($consultaSQL);
        foreach ($resultados as $fila){
            $frase = $fila['USERNAME'] . ": " . $fila['comentario'] . " (" . $fila['valoracion'] . ")";
            echo '<script>aniadirComents("' . $frase . '")</script>';
        }

        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valoracion = $_POST['asunto'];
        $comentario = $_POST['mensaje'];
        echo '<script src="generauser.js"></script>';
        $query = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
        parse_str($query, $params); 
        $idpeli = $params['q'];
        $consultaSQL = "INSERT INTO comentarios (idpeli, USERNAME, comentario, valoracion) VALUES (:idpeli, :username, :comentario, :valoracion)";
        $statement = $conexion->prepare($consultaSQL);
        $statement->bindValue(':idpeli', $idpeli, PDO::PARAM_STR);
        $statement->bindValue(':username', $nombre_usuario, PDO::PARAM_STR);
        $statement->bindValue(':comentario', $comentario, PDO::PARAM_STR);
        $statement->bindValue(':valoracion', $valoracion, PDO::PARAM_STR);
        $statement->execute();
        $ubi = "peli.php?q=" . $idpeli;
        header("Location: $ubi");
        exit();        
    }

} catch (PDOException $e) {
    echo "CONSULT ERROR: " . $e->getMessage();
}
$conexion = null;
?>
