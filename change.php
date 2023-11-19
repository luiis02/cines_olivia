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
if (!isset($_SESSION['nombre_usuario'])) {
    // Si el usuario no ha iniciado sesión, no redirijas, solo muestra el archivo index.html.
    header("Location: index.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
$tipo = $_SESSION['tipo'] ?? 'NOT';

try {
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consultaSQL = "SELECT * FROM USERS WHERE USERNAME='$nombre_usuario'";
    $resultados = $conexion->query($consultaSQL);
    $fila = $resultados->fetch();
    $user = $fila['USERNAME'];
    $nombre = $fila['NOMBRE'];
    $apellido = $fila['APELLIDO'];
    $telefono = $fila['TELEFONO'];
    $correo = $fila['CORREO'];
    header('Content-Type: text/html');
    readfile("change.html");
    echo '<script src="generauser.js"></script>';
    echo '<script>ocultaform("' . $nombre_usuario . '", "' . $tipo . '");</script>';
    echo "<script>generainfo('$user', '$nombre', '$apellido', '$telefono', '$correo');</script>";
    echo '<script>change_enlaces();</script>'; 



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = isset($_POST["user"]) ? $_POST["user"] : null;
        $name = isset($_POST["nombre"]) && $_POST["nombre"] !== '' ? $_POST["nombre"] : null;
        $apellido = isset($_POST["apellido"]) && $_POST["apellido"] !== '' ? $_POST["apellido"] : null;
        $telefono = isset($_POST["telefono"]) && $_POST["telefono"] !== '' ? $_POST["telefono"] : null;
        $correo = isset($_POST["correo"]) && $_POST["correo"] !== '' ? $_POST["correo"] : null;
        $contraseña = isset($_POST["contraseña"]) && $_POST["contraseña"] !== '' ? hash('sha256', $_POST["contraseña"]) : null;

        if(!is_null($username)){
            $consultaSQL = "SELECT COUNT(*) FROM USERS WHERE USERNAME = '$username';";
            try { 
                $result= $conexion->query( $consultaSQL ); 
                if($result->fetchColumn()==0){
                    $consultaSQL = "UPDATE USERS SET USERNAME = '$username' WHERE USERNAME = '$user';";
                    $_SESSION['nombre_usuario'] = $username;
                    try { 
                        $conexion->query( $consultaSQL ); 
                    } catch (PDOException $e) { 
                        echo "Consulta fallida: " . $e->getMessage(); 
                    } 
                    header("Location: $_SERVER[PHP_SELF]");
                    exit();       
                } else {
                    echo '<script src="generauser.js"></script>';
                    echo "<script>envia_warnings('USERNAME EN USO');</script>";    
                }

            } catch (PDOException $e) { 
                echo "Consulta fallida: " . $e->getMessage(); 
            }            
        }
        if (!is_null($name)) {
            $consultaSQL = "UPDATE USERS SET NOMBRE = '$name' WHERE USERNAME = '$user';";
            try { 
                $conexion->query( $consultaSQL ); 
            }catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); } 
            header("Location: change.php");
        }
        if (!is_null($apellido )) {
            $consultaSQL = "UPDATE USERS SET APELLIDO = '$apellido' WHERE USERNAME = '$user';";
            try { 
                $conexion->query( $consultaSQL ); 
            }catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); } 
            header("Location: change.php");
        }
        if(!is_null($telefono)){
            $consultaSQL = "SELECT COUNT(*) FROM USERS WHERE TELEFONO = '$telefono';";
            try { 
                $result= $conexion->query( $consultaSQL ); 
                if($result->fetchColumn()==0){
                    $consultaSQL = "UPDATE USERS SET TELEFONO = '$telefono' WHERE USERNAME = '$user';";
                    try { 
                        $conexion->query( $consultaSQL ); 
                    } catch (PDOException $e) { 
                        echo "Consulta fallida: " . $e->getMessage(); 
                    } 
                    header("Location: $_SERVER[PHP_SELF]");
                    exit();       
                } else {
                    echo '<script src="generauser.js"></script>';
                    echo "<script>envia_warnings('TELEFONO EN USO');</script>";    
                }

            } catch (PDOException $e) { 
                echo "Consulta fallida: " . $e->getMessage(); 
            }            
        }
        if(!is_null($correo)){
            $consultaSQL = "SELECT COUNT(*) FROM USERS WHERE CORREO = '$correo';";
            try { 
                $result= $conexion->query( $consultaSQL ); 
                if($result->fetchColumn()==0){
                    $consultaSQL = "UPDATE USERS SET CORREO = '$correo' WHERE USERNAME = '$user';";
                    try { 
                        $conexion->query( $consultaSQL ); 
                    } catch (PDOException $e) { 
                        echo "Consulta fallida: " . $e->getMessage(); 
                    } 
                    header("Location: $_SERVER[PHP_SELF]");
                    exit();       
                } else {
                    echo '<script src="generauser.js"></script>';
                    echo "<script>envia_warnings('CORREO EN USO');</script>";    
                }

            } catch (PDOException $e) { 
                echo "Consulta fallida: " . $e->getMessage(); 
            }            
        }
        if (!is_null($contraseña )) {
            $consultaSQL = "UPDATE USERS SET CONTRASENIA = '$contraseña' WHERE USERNAME = '$user';";
            try { 
                $conexion->query( $consultaSQL ); 
            }catch ( PDOException $e ) { echo "Consulta fallida: " . $e->getMessage(); } 
            header("Location: change.php");
        }
    }
    
} catch (PDOException $e) {
    echo "CONSULT ERROR: " . $e->getMessage();
}

$conexion = null;

if (isset($_GET['accion']) && $_GET['accion'] == 'cerrar_sesion') {
    session_destroy();
    exit();
}
?>
