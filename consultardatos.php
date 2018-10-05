<?php
    session_start();
    include("conexion.php");

    function encriptar($cadena){
      $key='darks';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
      $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
      return $encrypted; //Devuelve el string encriptado
    }

    function desencriptar($cadena){
       $key='darks';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
       $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
       return $decrypted;  //Devuelve el string desencriptado
    }

    $usu = encriptar($_POST['usuario']);
    $pas = encriptar($_POST['contraseña']);
    $sql = "SELECT * FROM personal WHERE usuario='$usu' AND contrasena COLLATE SQL_Latin1_General_CP1_CS_AS = '$pas'";
    $accion = sqlsrv_query( $conexion, $sql );

    if($accion){
        while( $line = sqlsrv_fetch_array( $accion, SQLSRV_FETCH_ASSOC)){
            $_SESSION['id'] = $line['idpersonal'];
            $_SESSION['personal'] = desencriptar($line['usuario']);
            $_SESSION['contraseña'] = desencriptar($line['contrasena']);
            $_SESSION['departamento'] = $line['departamentopersonal'];
            $_SESSION['perfil'] = $line['perfil'];
            $_SESSION['puesto'] = $line['puesto'];
        }

        if(isset($_SESSION['personal'])){
            header("Location: altausuario.php");
        } else {
            header("Location: redireccionar.php?mensaje=1");
        }
    } else {
        header("Location: redireccionar.php?mensaje=2");
    }
?>
