<?php
    define("DB_DSN", "mysql:host=localhost;dbname=dbluisalcalde_pw2223" );
    define("DB_USUARIO", "pwluisalcalde" );
    define("DB_PASSWORD", "22luisalcalde23" );

    try{
        $conexion = new PDO(DB_DSN,DB_USUARIO,DB_PASSWORD);
        $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }catch ( PDOException $e ) { echo "Conexión fallida: " . $e->getMessage(); }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre_usuario = $_POST["user"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $telefono = !empty($_POST["telefono"]) ? $_POST["telefono"] : null;
        $correo = $_POST["correo"];
        $contraseña = $_POST["contraseña"];
        $contraseña = hash('sha256', $contraseña);

        try{
            $consultaSQL = "SELECT COUNT(*) FROM USERS WHERE USERNAME = '$nombre_usuario';";
            try { 
                $result= $conexion->query( $consultaSQL ); 
                if($result->fetchColumn()!=0){
                    header('Content-Type: text/html');
                    readfile("altausuarios.html");
                    echo '<script src="generauser.js"></script>';
                    echo "<script>envia_warnings('Vaya! Ese nombre de usuario ya está en uso');</script>";  
                    exit();  
                }

            } catch (PDOException $e) { 
                echo "Consulta fallida: " . $e->getMessage(); 
            }
            
            
            if(!is_null($telefono)){
                $consultaSQL = "SELECT COUNT(*) FROM USERS WHERE TELEFONO = '$telefono';";
                try { 
                    $result= $conexion->query( $consultaSQL ); 
                    if($result->fetchColumn()!=0){
                        header('Content-Type: text/html');
                        readfile("altausuarios.html");
                        echo '<script src="generauser.js"></script>';
                        echo "<script>envia_warnings('Vaya! Ese email ya está en uso');</script>";  
                        exit();  
                    }
                } catch (PDOException $e) { 
                    echo "Consulta fallida: " . $e->getMessage(); 
                }            
            }

            $consultaSQL = "SELECT COUNT(*) FROM USERS WHERE CORREO = '$correo';";
            try { 
                $result= $conexion->query( $consultaSQL ); 
                if($result->fetchColumn()!=0){
                    header('Content-Type: text/html');
                    readfile("altausuarios.html");
                    echo '<script src="generauser.js"></script>';
                    echo "<script>envia_warnings('Vaya! Ese correo ya está en uso');</script>";  
                    exit();  
                }

            } catch (PDOException $e) { 
                echo "Consulta fallida: " . $e->getMessage(); 
            }

            $consultaSQL = "INSERT INTO USERS (USERNAME, NOMBRE, APELLIDO, TELEFONO, CORREO, CONTRASENIA, TIPO) VALUES ('$nombre_usuario', '$nombre', '$apellido', " . ($telefono ? "'$telefono'" : "NULL") . ", '$correo', '$contraseña' , 'Cliente')";
            $conexion->exec($consultaSQL);
            header("Location: index.php?new=t");
            

        }catch(PDOException $e) { echo "INSERT ERROR: " . $e->getMessage(); } 
        $conexion = null;
    }else{
        // Cargar altausuarios.html por defecto
    header('Content-Type: text/html');
    readfile("altausuarios.html");
    }
?>
