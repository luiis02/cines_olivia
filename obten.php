<?php
define("DB_DSN", "mysql:host=localhost;dbname=dbluisalcalde_pw2223");
define("DB_USUARIO", "pwluisalcalde");
define("DB_PASSWORD", "22luisalcalde23");

$cadena = $_GET["q"]; // Utilizamos $_GET en lugar de $_REQUEST para obtener el parámetro "q"

try {
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Usamos prepared statements para evitar posibles ataques de inyección SQL
    $consultaSQL = "SELECT categoria FROM peliculas WHERE id = :id";
    $statement = $conexion->prepare($consultaSQL);
    $statement->bindParam(":id", $cadena);
    $statement->execute();
    
    $resultado = $statement->fetchColumn();
    
    // Devolvemos la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($resultado);
} catch (PDOException $e) {
    echo "CONSULT ERROR: " . $e->getMessage();
}
$conexion = null;
?>
