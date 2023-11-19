<?php
define("DB_DSN", "mysql:host=localhost;dbname=dbluisalcalde_pw2223");
define("DB_USUARIO", "pwluisalcalde");
define("DB_PASSWORD", "22luisalcalde23");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["usuario"];
    $contraseña = $_POST["contrasena"];
    $contraseña = hash('sha256', $contraseña);
    
    try {
        // CONEXIÓN A LA BD
        $conexion = new PDO(DB_DSN, DB_USUARIO, DB_PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $consultaSQL = "SELECT count(*) FROM USERS WHERE USERNAME=:nombre_usuario AND CONTRASENIA=:contrasena";
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->bindParam(':nombre_usuario', $nombre_usuario);
        $sentencia->bindParam(':contrasena', $contraseña);
        $sentencia->execute();
        
        $valor = $sentencia->fetchColumn();
        $valor = intval($valor); // Convertir a entero si es necesario
        
        if ($valor == 0) {
            header('Location: index.php?l=i');
            echo '<script src="generauser.js"></script>';
            echo '<script>envia_warnings("USER/PSWD INCORRECTA");</script>';
            exit();
        } else {
            session_start();
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            $consultaSQL = "SELECT TIPO FROM USERS WHERE USERNAME=:nombre_usuario";
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->bindParam(':nombre_usuario', $nombre_usuario);
            $sentencia->execute();
            
            $fila = $sentencia->fetch();
            $_SESSION['tipo'] = $fila['TIPO'];
            header("Location: index.php");
        }
    } catch (PDOException $e) {
        echo "CONSULT ERROR: " . $e->getMessage();
    }
    $conexion = null;
}
?>





